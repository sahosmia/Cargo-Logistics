<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Cache;

class VerifyOTPAction
{
    public function execute(string $phone, string $otp): bool
    {
        $cachedOtp = Cache::get("otp_{$phone}");

        if ($cachedOtp && $cachedOtp === $otp) {
            Cache::forget("otp_{$phone}");

            return true;
        }

        return false;
    }
}
