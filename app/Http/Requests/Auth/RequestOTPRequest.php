<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Concerns\ValidatesOTPAttributes;
use Illuminate\Foundation\Http\FormRequest;

class RequestOTPRequest extends FormRequest
{
    use ValidatesOTPAttributes;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->otpRequestRules();
    }

    public function messages(): array
    {
        return $this->otpAttributeMessages();
    }
}
