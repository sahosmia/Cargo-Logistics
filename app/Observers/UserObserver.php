<?php

namespace App\Observers;

use App\Enums\UserRole;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        $isCustomer = $user->role === UserRole::Customer || $user->role === 'customer';

        if ($isCustomer && empty($user->customer_code)) {
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

            $user->customer_code = $code;
        }
    }
}
