<?php

namespace App\Http\Controllers;

use App\Actions\Bookings\UpdateBookingStatusAction;
use App\Enums\UserRole;
use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\UpdateBookingStatusRequest;
use App\Models\Booking;
use App\Models\Category;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class BookingController extends Controller
{
    /**
     * Show the booking creation form.
     */
    public function create(): View
    {
        return view('booking.form');
    }

    /**
     * Display a listing of bookings.
     */
    public function index(Request $request): InertiaResponse
    {
        $user = auth()->user() ?: auth('customer')->user();
        $query = Booking::query();

        if ($user && $user->role === UserRole::Customer) {
            $query->where('user_id', $user->id);
        }

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('shipping_mark', 'LIKE', "%{$search}%")
                    ->orWhere('item_name', 'LIKE', "%{$search}%")
                    ->orWhere('tracking', 'LIKE', "%{$search}%");
            });
        }

        $bookings = $query->with(['category', 'district', 'user', 'histories.user'])
            ->latest()
            ->paginate(settings('paginated_quantity', 10));

        return Inertia::render('Bookings/Index', [
            'bookings' => $bookings,
        ]);
    }

    /**
     * Display the specified booking.
     */
    public function show(Booking $booking): InertiaResponse
    {
        Gate::authorize('view', $booking);

        $booking->load(['category', 'district', 'user', 'histories.user']);

        return Inertia::render('Bookings/Show', [
            'booking' => $booking,
        ]);
    }

    /**
     * Display the invoice for the booking.
     */
    public function invoice(Booking $booking): InertiaResponse
    {
        Gate::authorize('view', $booking);

        $booking->load(['category', 'district', 'user']);

        return Inertia::render('Bookings/Invoice', [
            'booking' => $booking,
        ]);
    }

    /**
     * Get a list of filtered shipping categories.
     */
    public function getCategories(Request $request): JsonResponse
    {
        $query = $request->get('q');
        $method = $request->get('method');

        $dbQuery = Category::query();

        if ($query) {
            $dbQuery->where('name', 'LIKE', "%{$query}%");
        }

        if (strtolower($method) === 'sea') {
            $dbQuery->whereNotNull('sea_price_start')
                ->whereNotNull('sea_price_end');
        } elseif (strtolower($method) === 'air') {
            $dbQuery->whereNotNull('air_price_start')
                ->whereNotNull('air_price_end');
        }

        $categories = $dbQuery->limit(15)
            ->get([
                'id',
                'name',
                'sea_price_start',
                'sea_price_end',
                'air_price_start',
                'air_price_end',
            ]);

        return response()->json($categories);
    }

    /**
     * Get a list of districts based on search criteria.
     */
    public function getDistricts(Request $request): JsonResponse
    {
        $query = $request->get('q');

        $districts = District::where('name', 'LIKE', "%{$query}%")
            ->get(['id', 'name']);

        return response()->json($districts);
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(BookingStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = auth()->user() ?: auth('customer')->user();

        if (!$user) {
            abort(401, 'Unauthorized');
        }

        DB::transaction(function () use ($validated, $user, $request) {
            Booking::create([
                'user_id' => $user->id,
                'item_name' => $validated['item_name'],
                'category_id' => $validated['category_id'],
                'method' => $validated['method'],
                'tracking' => $validated['tracking'],
                'total_carton' => $validated['total_carton'],
                'total_quantity' => $validated['total_quantity'],
                'total_weight' => $validated['total_weight'],
                'sensitive_goods' => $request->boolean('sensitive_goods'),
                'delivery_method' => $validated['delivery_method'],
                'district_id' => $validated['district_id'],
                'address' => $validated['address'],
                'note' => $validated['note'] ?? null,
            ]);
        });

        return redirect()->route('bookings.index')->with('success', 'Booking placed successfully!');
    }

    /**
     * Update the status and specifications of a booking.
     */
    public function updateStatus(
        UpdateBookingStatusRequest $request,
        Booking $booking,
        UpdateBookingStatusAction $updateBookingStatusAction
    ): RedirectResponse {
        $validated = $request->validated();

        if (isset($validated['status']) && $validated['status'] === 'delivered') {
            $validated['payment_status'] = 'paid';
        }

        DB::transaction(function () use ($validated, $booking, $updateBookingStatusAction) {
            $booking->update(array_filter([
                'total_weight' => $validated['total_weight'] ?? null,
                'unit_price' => $validated['unit_price'] ?? null,
                'total_price' => $validated['total_price'] ?? null,
                'payment_status' => $validated['payment_status'] ?? null,
            ], fn ($value) => ! is_null($value)));

            $updateBookingStatusAction->execute($booking, $validated['status'], $validated['comment'] ?? null);
        });

        return back()->with('success', 'Booking status updated successfully!');
    }
}
