<?php

namespace App\Observers;

use App\Models\Booking;
use App\Models\BookingHistory;

class BookingObserver
{
    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $booking): void
    {
        if ($booking->isDirty('status')) {
            BookingHistory::create([
                'booking_id' => $booking->id,
                'status' => $booking->status ?? 'pending',
                'changed_by' => auth()->id(),
                'comment' => request('comment') ?? 'Status updated',
            ]);
        }
    }

    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking): void
    {
        BookingHistory::create([
            'booking_id' => $booking->id,
            'status' => $booking->status ?? 'pending',
            'changed_by' => auth()->id(),
            'comment' => 'Booking created',
        ]);
    }
}
