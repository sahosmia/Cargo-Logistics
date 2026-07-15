<?php

namespace App\Http\Requests\Concerns;

trait ValidatesOTPAttributes
{
    /**
     * @return array<string, mixed>
     */
    protected function otpRequestRules(): array
    {
        return [
            'phone_number' => ['required', 'string', 'regex:/^[0-9]+$/', 'min:10'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function otpVerifyRules(): array
    {
        return [
            'phone_number' => ['required', 'string'],
            'otp' => ['required', 'string', 'size:6'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function otpAttributeMessages(): array
    {
        return [
            'phone_number.required' => 'Phone number is required',
            'phone_number.regex' => 'Phone number must only contain digits',
            'phone_number.min' => 'Phone number must be at least 10 digits long',
            'otp.required' => 'OTP is required',
            'otp.size' => 'OTP must be exactly 6 digits long',
        ];
    }
}
