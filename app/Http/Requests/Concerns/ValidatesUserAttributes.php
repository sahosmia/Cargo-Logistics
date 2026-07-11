<?php

namespace App\Http\Requests\Concerns;

use Illuminate\Contracts\Validation\ValidationRule;

trait ValidatesUserAttributes
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    protected function userAttributeRules(): array
    {
        $userId = $this->route('user') ? $this->route('user')->id : null;

        return [
            'name' => 'required|string|max:255',
            'email' => "required|email|max:255|unique:users,email,{$userId}",
            'phone_number' => 'nullable|string|max:20',
            'role' => ['required', 'string'],
            'password' => $this->isMethod('post')
                   ? 'required|string|min:6'
                : 'nullable|string|min:6',
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function userAttributeMessages(): array
    {
        return [
            'name.required' => 'User name is required',
            'email.required' => 'Email address is required',
            'email.unique' => 'This email is already registered',
            'role.required' => 'Please select a role for the user',
        ];
    }
}
