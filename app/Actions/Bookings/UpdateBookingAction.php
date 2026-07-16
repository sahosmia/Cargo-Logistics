<?php

namespace App\Actions\Bookings;

use App\Models\Booking;

class UpdateBookingAction
{
    /**
     * Update the booking with validated data.
     */
    public function execute(Booking $booking, array $data): bool
    {
        return $booking->update($data);
    }
}
