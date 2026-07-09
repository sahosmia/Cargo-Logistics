<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $data = [
            'total_bookings' => 0,
            'pending_bookings' => 0,
            'received_bookings' => 0,
            'shipped_bookings' => 0,
            'delivered_bookings' => 0,
            'recent_bookings' => [],
        ];

        $query = Booking::query();
        if ($user->role === 'customer') {
            $query->where('user_id', $user->id);
        }

        $data['total_bookings'] = (clone $query)->count();
        $data['pending_bookings'] = (clone $query)->where('status', 'pending')->count();
        $data['received_bookings'] = (clone $query)->where('status', 'received_in_china')->count();
        $data['shipped_bookings'] = (clone $query)->where('status', 'in_transit')->count();
        $data['delivered_bookings'] = (clone $query)->where('status', 'delivered')->count();

        $data['recent_bookings'] = $query->with(['user', 'category', 'district'])
            ->latest()
            ->limit(5)
            ->get();

        return Inertia::render('dashboard', [
            'stats' => $data
        ]);
    }
}
