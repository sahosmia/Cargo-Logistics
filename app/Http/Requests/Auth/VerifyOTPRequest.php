<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Concerns\ValidatesOTPAttributes;
use Illuminate\Foundation\Http\FormRequest;

class VerifyOTPRequest extends FormRequest
{
    use ValidatesOTPAttributes;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->otpVerifyRules();
    }

    public function messages(): array
    {
        return $this->otpAttributeMessages();
    }
}
