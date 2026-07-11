<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ValidatesSettingsAttributes;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
{
    use ValidatesSettingsAttributes;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->settingsAttributeRules();
    }

    public function messages(): array
    {
        return $this->settingsAttributeMessages();
    }
}
