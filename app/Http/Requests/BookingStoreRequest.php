<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'method' => 'required',
            'tracking' => 'required|array',
            'tracking.*' => 'required',
            'item_name' => 'required',
            'category_id' => 'required',
            'total_carton' => 'required|numeric',
            'total_quantity' => 'required|numeric',
            'total_weight' => 'required|numeric',
            'delivery_method' => 'required',
            'district_id' => 'required',
            'address' => 'required',
            'sensitive_goods' => 'nullable|boolean',
            'note' => 'nullable|string',
        ];
    }
}
