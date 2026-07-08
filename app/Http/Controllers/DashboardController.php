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

        if ($user->role === 'customer') {
            $query = Booking::where('user_id', $user->id);

            $data['total_bookings'] = (clone $query)->count();
            $data['pending_bookings'] = (clone $query)->where('status', 'pending')->count();
            $data['received_bookings'] = (clone $query)->where('status', 'received')->count();
            $data['shipped_bookings'] = (clone $query)->where('status', 'shipped')->count();
            $data['delivered_bookings'] = (clone $query)->where('status', 'delivered')->count();

            $data['recent_bookings'] = $query->with(['category', 'district'])
                ->latest()
                ->limit(5)
                ->get();
        } else {
            // Admin stats
            $data['total_bookings'] = Booking::count();
            $data['pending_bookings'] = Booking::where('status', 'pending')->count();
            $data['received_bookings'] = Booking::where('status', 'received')->count();

            $data['recent_bookings'] = Booking::with(['user', 'category', 'district'])
                ->latest()
                ->limit(5)
                ->get();
        }

        return Inertia::render('dashboard', [
            'stats' => $data
        ]);
    }
}
