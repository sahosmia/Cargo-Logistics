<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Booking;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user() ?: auth('customer')->user();

        if (! $user) {
            return redirect()->route('login');
        }

        // Redirect customer to customer dashboard if they are on admin dashboard route
        if ($user->role === UserRole::Customer && request()->routeIs('dashboard')) {
            return redirect()->route('customer.dashboard');
        }

        // Redirect admin/staff to admin dashboard if they are on customer dashboard route
        if ($user->role !== UserRole::Customer && request()->routeIs('customer.dashboard')) {
            return redirect()->route('dashboard');
        }

        $data = [
            'total_bookings' => 0,
            'pending_bookings' => 0,
            'received_bookings' => 0,
            'shipped_bookings' => 0,
            'delivered_bookings' => 0,
            'recent_bookings' => [],
        ];

        $query = Booking::query();
        if ($user->role === UserRole::Customer) {
            $query->where('user_id', $user->id);
        }

        $data['total_bookings'] = (clone $query)->count();
        $data['pending_bookings'] = (clone $query)->where('status', 'pending')->count();
        $data['received_bookings'] = (clone $query)->where('status', 'received_in_china')->count();
        $data['shipped_bookings'] = (clone $query)->where('status', 'in_transit')->count();
        $data['delivered_bookings'] = (clone $query)->where('status', 'delivered')->count();

        $data['recent_bookings'] = $query->with(['user', 'category', 'district', 'histories.user'])
            ->latest()
            ->limit(5)
            ->get();

        return Inertia::render('dashboard', [
            'stats' => $data,
        ]);
    }
}
