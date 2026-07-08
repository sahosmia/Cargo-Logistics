<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ValidatesDistrictAttributes;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDistrictRequest extends FormRequest
{
    use ValidatesDistrictAttributes;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->districtAttributeRules();
    }

    public function messages(): array
    {
        return $this->districtAttributeMessages();
    }
}
