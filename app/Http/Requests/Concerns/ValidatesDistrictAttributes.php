<?php

namespace App\Http\Requests\Concerns;

use Illuminate\Contracts\Validation\ValidationRule;

trait ValidatesDistrictAttributes
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    protected function districtAttributeRules(): array
    {
        $districtId = $this->route('district') ? $this->route('district')->id : null;

        return [
            'name' => "required|string|max:255|unique:districts,name,{$districtId}",
            'code' => 'nullable|string|max:10',
            'status' => 'boolean',
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function districtAttributeMessages(): array
    {
        return [
            'name.required' => 'District name is required',
            'name.unique' => 'This district name is already registered',
        ];
    }
}
