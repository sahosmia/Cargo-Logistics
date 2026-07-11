<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\Concerns\ValidatesProfileAttributes;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
        $userId = $this->user()?->id;
        $isCustomer = (bool) $this->user('customer');

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
