<?php

namespace App\Observers;

use App\Models\Shipment;
use App\Models\User;

class ShipmentObserver
{
    /**
     * Handle the Shipment "creating" event.
     */
    public function creating(Shipment $shipment): void
    {
        $user = $shipment->user;
        if (! $user) {
            $customerCode = 'CVS-GUEST';
        } else {
            $customerCode = $user->customer_code;
            if (empty($customerCode)) {
                $customerCode = $this->generateCustomerCode($user);
                $user->customer_code = $customerCode;
                $user->save();
            }
        }

        $dateStr = now()->format('ymd'); // YYMMDD (e.g., 260712)
        $baseMark = "{$customerCode}-{$dateStr}";

        $shippingMark = $baseMark;
        $counter = 1;
        while (Shipment::where('shipping_mark', $shippingMark)->exists()) {
            $shippingMark = "{$baseMark}-{$counter}";
            $counter++;
        }

        $shipment->shipping_mark = $shippingMark;
    }

    /**
     * Helper to generate customer code if missing.
     */
    private function generateCustomerCode(User $user): string
    {
        $latestUser = User::whereNotNull('customer_code')
            ->where('customer_code', 'LIKE', 'CVS-%')
            ->orderByRaw('CAST(SUBSTRING(customer_code, 5) AS UNSIGNED) DESC')
            ->first();

        $nextNum = 1001;
        if ($latestUser) {
            $nextNum = ((int) substr($latestUser->customer_code, 4)) + 1;
        }

        do {
            $code = 'CVS-'.$nextNum;
            $exists = User::where('customer_code', $code)->exists();
            if ($exists) {
                $nextNum++;
            }
        } while ($exists);

        return $code;
    }
}
