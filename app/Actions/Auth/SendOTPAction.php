<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SendOTPAction
{
    public function execute(string $phone, string $otp): void
    {
        // Store in cache for 5 minutes
        Cache::put("otp_{$phone}", $otp, now()->addMinutes(5));

        // Log the OTP for local debugging
        Log::info("OTP for {$phone}: {$otp}");
    }
}
