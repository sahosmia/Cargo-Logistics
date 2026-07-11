<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ValidatesRoleAttributes;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    use ValidatesRoleAttributes;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->roleAttributeRules();
    }

    public function messages(): array
    {
        return $this->roleAttributeMessages();
    }
}
