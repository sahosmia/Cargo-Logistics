<?php

namespace App\Http\Controllers;

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
        $request->validate([
            'method' => 'required',
            'tracking.*' => 'required',
            'item_name' => 'required',
            'category_id' => 'required',
            'total_carton' => 'required|numeric',
            'total_quantity' => 'required|numeric',
            'total_weight' => 'required|numeric',
            'delivery_method' => 'required',
            'district_id' => 'required',
            'address' => 'required',
        ]);

        // Logic to save booking would go here

        return back()->with('success', 'Booking placed successfully!');
    }
}
