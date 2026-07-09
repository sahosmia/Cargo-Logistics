<?php

namespace App\Http\Controllers;

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
}
