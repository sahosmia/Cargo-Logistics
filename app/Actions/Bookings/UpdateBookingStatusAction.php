<?php

namespace App\Actions\Bookings;

use App\Models\Booking;
use Illuminate\Support\Facades\Gate;

class UpdateBookingStatusAction
{
    public function execute(Booking $booking, string $status, ?string $comment = null): Booking
    {
        Gate::authorize('updateStatus', [$booking, $status]);

        $booking->update([
            'status' => $status,
        ]);

        // Comment is handled by Observer via request('comment')
        // but we can also explicitly set it if needed.

        return $booking;
    }
}
