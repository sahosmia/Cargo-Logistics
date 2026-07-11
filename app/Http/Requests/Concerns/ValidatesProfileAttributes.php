<?php

namespace App\Http\Requests\Concerns;

use App\Models\User;
use Illuminate\Validation\Rule;

trait ValidatesProfileAttributes
{
    /**
     * @return array<string, mixed>
     */
    protected function profileUpdateRules(?int $userId = null, bool $isCustomer = false): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                $isCustomer ? 'nullable' : 'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                $userId ? Rule::unique(User::class)->ignore($userId) : Rule::unique(User::class),
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function profileDeleteRules(): array
    {
        return [
            'password' => ['required', 'current_password'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function profileAttributeMessages(): array
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email address is required',
            'email.email' => 'Please provide a valid email address',
            'email.unique' => 'This email is already registered',
            'password.required' => 'Password is required to delete the profile',
            'password.current_password' => 'The provided password does not match your current password',
        ];
    }
}
