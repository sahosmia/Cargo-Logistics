<?php

namespace App\Actions\Bookings;

use App\Models\Booking;

class StoreBookingAction
{
    /**
     * Create and persist a new booking.
     */
    public function execute(array $data): Booking
    {
        return Booking::create($data);
    }
}
