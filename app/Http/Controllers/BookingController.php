<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\District;
use Illuminate\Http\Request;
use Inertia\Inertia;


class BookingController extends Controller
{
    public function index()
    {
        return view('booking.form');
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'method' => 'required',
            'tracking' => 'required|array',
            'tracking.*' => 'required',
            'item_name' => 'required',
            'category_id' => 'required',
            'total_carton' => 'required|numeric',
            'total_quantity' => 'required|numeric',
            'total_weight' => 'required|numeric',
            'delivery_method' => 'required',
            'district_id' => 'required',
            'address' => 'required',
            'sensitive_goods' => 'nullable|boolean',
            'note' => 'nullable|string',
        ]);

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
