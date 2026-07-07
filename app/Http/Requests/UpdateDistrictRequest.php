<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDistrictRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $districtId = $this->route('district') ? $this->route('district')->id : null;

        return [
            'name' => "required|string|max:255|unique:districts,name,{$districtId}",
            'code' => 'nullable|string|max:10',
            'status' => 'boolean',
        ];
    }
}
