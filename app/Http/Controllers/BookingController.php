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
}
