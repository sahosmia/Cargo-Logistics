<?php

namespace App\Observers;

use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\BookingHistory;
use App\Models\User;
use App\Notifications\BookingCreatedNotification;
use App\Notifications\BookingStatusChangedNotification;
use Illuminate\Support\Facades\Log;

class BookingObserver
{
    /**
     * Handle the Booking "creating" event.
     */
    public function creating(Booking $booking): void
    {
        if (empty($booking->shipping_mark)) {
            $user = $booking->user;
            if ($user && ($user->role === UserRole::Customer || $user->role === 'customer')) {
                $customerCode = $user->customer_code;
                if (empty($customerCode)) {
                    $customerCode = $this->generateCustomerCode($user);
                    $user->customer_code = $customerCode;
                    $user->save();
                }

                $dateStr = now()->format('ymd'); // YYMMDD (e.g., 260712)
                $baseMark = "{$customerCode}-{$dateStr}";

                $shippingMark = $baseMark;
                $counter = 1;
                while (Booking::where('shipping_mark', $shippingMark)->exists()) {
                    $shippingMark = "{$baseMark}-{$counter}";
                    $counter++;
                }

                $booking->shipping_mark = $shippingMark;
            }
        }
    }

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
                'comment' => filled(request('comment')) ? trim(request('comment')) : null,
            ]);

            $user = $booking->user;
            if ($user) {
                try {
                    $user->notify(new BookingStatusChangedNotification($booking));
                } catch (\Exception $e) {
                    Log::error('Failed to send booking status changed notification: '.$e->getMessage());
                }
            }
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

        $user = $booking->user;
        if ($user) {
            try {
                $user->notify(new BookingCreatedNotification($booking));
            } catch (\Exception $e) {
                Log::error('Failed to send booking created notification: '.$e->getMessage());
            }
        }
    }

    /**
     * Helper to generate customer code if missing.
     */
    private function generateCustomerCode(User $user): string
    {
        $latestUser = User::whereNotNull('customer_code')
            ->where('customer_code', 'LIKE', 'TP-%')
            ->orderByRaw('CAST(SUBSTRING(customer_code, 4) AS UNSIGNED) DESC')
            ->first();

        $nextNum = 1001;
        if ($latestUser) {
            $nextNum = ((int) substr($latestUser->customer_code, 3)) + 1;
        }

        do {
            $code = 'TP-'.$nextNum;
            $exists = User::where('customer_code', $code)->exists();
            if ($exists) {
                $nextNum++;
            }
        } while ($exists);

        return $code;
    }
}
