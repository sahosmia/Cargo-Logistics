<?php

namespace App\Policies;

use App\Enums\BookingStatus;
use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BookingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Authenticatable $user): bool
    {
        if ($user->role === UserRole::Customer || $user->role === 'customer') {
            return true;
        }

        return method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('view bookings');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Authenticatable $user, Booking $booking): bool
    {
        if ($user->role === UserRole::Customer || $user->role === 'customer') {
            return $user->getAuthIdentifier() === $booking->user_id;
        }

        if (method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('view bookings')) {
            return true;
        }

        return $user->getAuthIdentifier() === $booking->user_id;
    }

    /**
     * Determine whether the user can update the status of the booking.
     */
    public function updateStatus(Authenticatable $user, Booking $booking, string $newStatus): bool
    {
        if ($user->role === UserRole::Customer || $user->role === 'customer') {
            return false;
        }

        if (! $user->hasPermissionTo('update booking status')) {
            return false;
        }

        $currentStatus = BookingStatus::tryFrom($booking->status);
        $targetStatus = BookingStatus::tryFrom($newStatus);

        if (! $currentStatus || ! $targetStatus) {
            return false;
        }

        // Check if transition is allowed in linear lifecycle
        $allowedNext = $currentStatus->nextStatuses();
        if (! in_array($targetStatus, $allowedNext) && $booking->status !== $newStatus) {
            return false;
        }

        // Role based restrictions
        if (method_exists($user, 'hasRole')) {
            if ($user->hasRole('Super Admin')) {
                return true;
            }

            if ($user->hasRole('China Warehouse Manager')) {
                return in_array($targetStatus, [
                    BookingStatus::ReceivedInChina,
                    BookingStatus::InTransit,
                    BookingStatus::Cancelled,
                ]);
            }

            if ($user->hasRole('BD Warehouse Manager')) {
                return in_array($targetStatus, [
                    BookingStatus::ArrivedInBD,
                    BookingStatus::CustomsCleared,
                    BookingStatus::ReadyForDelivery,
                    BookingStatus::Delivered,
                ]);
            }
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Booking $booking): bool
    {
        if ($user->role === UserRole::Customer || $user->role === 'customer') {
            return false;
        }

        return $user->hasPermissionTo('delete bookings');
    }
}
