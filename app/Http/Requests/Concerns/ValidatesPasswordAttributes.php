<?php

namespace App\Http\Requests\Concerns;

use Illuminate\Validation\Rules\Password;

trait ValidatesPasswordAttributes
{
    /**
     * @return array<string, mixed>
     */
    protected function passwordRules(): array
    {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function passwordMessages(): array
    {
        return [
            'current_password.required' => 'Current password is required',
            'current_password.current_password' => 'The provided password does not match your current password',
            'password.required' => 'New password is required',
            'password.confirmed' => 'New password confirmation does not match',
        ];
    }
}
