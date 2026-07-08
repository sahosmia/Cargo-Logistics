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
            ->get(['id', 'name']);

        return response()->json($categories);
    }

    public function getDistricts(Request $request)
    {
        $query = $request->get('q');

        $districts = District::where('name', 'LIKE', "%{$query}%")
            ->limit(15)
            ->get(['id', 'name']);

        return response()->json($districts);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'method' => 'required|string',
            'tracking' => 'required|array',
            'tracking.*' => 'required|string',
            'item_name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'total_carton' => 'required|integer',
            'total_quantity' => 'required|integer',
            'total_weight' => 'required|numeric',
            'sensitive_goods' => 'nullable|boolean',
            'delivery_method' => 'required|string',
            'district_id' => 'required|exists:districts,id',
            'address' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['sensitive_goods'] = $request->boolean('sensitive_goods');

        Booking::create($validated);

        return back()->with('success', 'Booking placed successfully!');
    }
}
