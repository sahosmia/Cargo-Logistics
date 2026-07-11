<?php

namespace App\Http\Requests\Settings;

use App\Enums\UserRole;
use App\Http\Requests\Concerns\ValidatesProfileAttributes;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    use ValidatesProfileAttributes;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->user('customer') ?: $this->user();
        $userId = $user?->id;
        $isCustomer = $user && ($user->role === UserRole::Customer || Auth::guard('customer')->check());

        return $this->profileUpdateRules($userId, $isCustomer);
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return $this->profileAttributeMessages();
    }
}
