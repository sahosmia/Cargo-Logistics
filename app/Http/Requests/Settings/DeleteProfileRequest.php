<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\Concerns\ValidatesProfileAttributes;
use Illuminate\Foundation\Http\FormRequest;

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
        if ($this->user('customer')) {
            return [];
        }

        return $this->profileDeleteRules();
    }

    public function messages(): array
    {
        return $this->profileAttributeMessages();
    }
}
