<?php

namespace App\Actions\Bookings;

use App\Models\Booking;

class DeleteBookingAction
{
    /**
     * Delete the specified booking.
     */
    public function execute(Booking $booking): ?bool
    {
        return $booking->delete();
    }
}
