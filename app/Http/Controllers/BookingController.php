<?php

namespace App\Http\Controllers;

use App\Actions\Bookings\UpdateBookingStatusAction;
use App\Http\Requests\BookingStoreRequest;
use App\Models\Booking;
use App\Models\Category;
use App\Models\District;
use Illuminate\Http\Request;
use Inertia\Inertia;


class BookingController extends Controller
{
    public function create()
    {
        return view('booking.form');
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Booking::query();

        if ($user->role === 'customer') {
            $query->where('user_id', $user->id);
        }

        $bookings = $query->with(['category', 'district', 'user'])
            ->latest()
            ->paginate(settings('paginated_quantity', 10));

        return Inertia::render('Bookings/Index', [
            'bookings' => $bookings
        ]);
    }

    public function getCategories(Request $request)
    {
        $query = $request->get('q');

        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->limit(15)
            ->get(['id', 'name', 'price_start', 'price_end']);

        return response()->json($categories);
    }

    public function getDistricts(Request $request)
    {
        $query = $request->get('q');

        $districts = District::where('name', 'LIKE', "%{$query}%")
            ->get(['id', 'name']);

        return response()->json($districts);
    }

    public function store(BookingStoreRequest $request)
    {
        $validated = $request->validated();

        Booking::create([
            'user_id' => auth()->id(),
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

        return back()->with('success', 'Booking placed successfully!');
    }

    public function updateStatus(Request $request, Booking $booking, UpdateBookingStatusAction $updateBookingStatusAction)
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'comment' => 'nullable|string',
            'total_weight' => 'nullable|numeric|min:0',
            'unit_price' => 'nullable|numeric|min:0',
            'total_price' => 'nullable|numeric|min:0',
            'payment_status' => 'nullable|string|in:pending,paid',
        ]);

        // Logic to trigger payment completion
        if (isset($validated['status']) && $validated['status'] === 'delivered') {
            $validated['payment_status'] = 'paid';
        }

        $booking->update(array_filter([
            'total_weight' => $validated['total_weight'] ?? null,
            'unit_price' => $validated['unit_price'] ?? null,
            'total_price' => $validated['total_price'] ?? null,
            'payment_status' => $validated['payment_status'] ?? null,
        ], fn($value) => !is_null($value)));

        $updateBookingStatusAction->execute($booking, $validated['status'], $validated['comment'] ?? null);

        return back()->with('success', 'Booking status updated successfully!');
    }
}
