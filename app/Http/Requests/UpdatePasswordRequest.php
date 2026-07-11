<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ValidatesPasswordAttributes;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    use ValidatesPasswordAttributes;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->passwordRules();
    }

    public function messages(): array
    {
        return $this->passwordMessages();
    }
}
