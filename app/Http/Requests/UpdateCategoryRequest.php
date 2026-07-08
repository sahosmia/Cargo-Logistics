<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ValidatesCategoryAttributes;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    use ValidatesCategoryAttributes;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->categoryAttributeRules();
    }

    public function messages(): array
    {
        return $this->categoryAttributeMessages();
    }
}
