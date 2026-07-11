<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ValidatesBookingAttributes;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingStatusRequest extends FormRequest
{
    use ValidatesBookingAttributes;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->bookingUpdateStatusRules();
    }

    public function messages(): array
    {
        return $this->bookingAttributeMessages();
    }
}
