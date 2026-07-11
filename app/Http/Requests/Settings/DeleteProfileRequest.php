<?php

namespace App\Http\Requests\Settings;

use App\Enums\UserRole;
use App\Http\Requests\Concerns\ValidatesProfileAttributes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeleteProfileRequest extends FormRequest
{
    use ValidatesProfileAttributes;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Customers do not need a password to delete their account as per ProfileController logic
        $user = $this->user('customer') ?: $this->user();
        if ($user && ($user->role === UserRole::Customer || Auth::guard('customer')->check())) {
            return [];
        }

        return $this->profileDeleteRules();
    }

    public function messages(): array
    {
        return $this->profileAttributeMessages();
    }
}
