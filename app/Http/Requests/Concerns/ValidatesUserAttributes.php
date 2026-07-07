<?php

namespace App\Http\Requests\Concerns;

use App\Enums\UserRole;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

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
            'phone' => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:255',
            'role' => ['required', Rule::in(UserRole::values())],
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
