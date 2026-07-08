<?php

namespace App\Support;

class StaticData
{
    /**
     * Get the list of countries.
     *
     * @return array<string, string>
     */
    public static function countries(): array
    {
        return [
            'BD' => 'Bangladesh',
            'US' => 'United States',
            'GB' => 'United Kingdom',
            'CA' => 'Canada',
            'AU' => 'Australia',
            // Add more as needed
        ];
    }

    /**
     * Get the list of currencies.
     *
     * @return array<string, string>
     */
    public static function currencies(): array
    {
        return [
            'BDT' => 'Bangladeshi Taka',
            'USD' => 'US Dollar',
            'EUR' => 'Euro',
            'GBP' => 'British Pound',
        ];
    }

    /**
     * Get the list of shipping methods.
     *
     * @return array<string, string>
     */
    public static function shippingMethods(): array
    {
        return [
            'standard' => 'Standard Shipping',
            'express' => 'Express Shipping',
            'pickup' => 'Store Pickup',
        ];
    }

    /**
     * Get the list of payment statuses.
     *
     * @return array<string, string>
     */
    public static function paymentStatuses(): array
    {
        return [
            'pending' => 'Pending',
            'paid' => 'Paid',
            'failed' => 'Failed',
            'refunded' => 'Refunded',
        ];
    }
}
