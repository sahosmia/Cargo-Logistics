<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Concerns\ValidatesRegisterAttributes;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    use ValidatesRegisterAttributes;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->registerRules();
    }

    public function messages(): array
    {
        return $this->registerMessages();
    }
}
