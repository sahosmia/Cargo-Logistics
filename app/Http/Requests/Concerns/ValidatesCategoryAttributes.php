<?php

namespace App\Http\Requests\Concerns;

use Illuminate\Contracts\Validation\ValidationRule;

trait ValidatesCategoryAttributes
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    protected function categoryAttributeRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'sea_price_start' => 'nullable|required_without:air_price_start|numeric|min:0|required_with:sea_price_end',
            'sea_price_end' => 'nullable|required_with:sea_price_start|numeric|gte:sea_price_start',
            'air_price_start' => 'nullable|required_without:sea_price_start|numeric|min:0|required_with:air_price_end',
            'air_price_end' => 'nullable|required_with:air_price_start|numeric|gte:air_price_start',
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function categoryAttributeMessages(): array
    {
        return [
            'name.required' => 'Category name is required',
            'sea_price_start.required_without' => 'Either Sea or Air price is required',
            'sea_price_start.required_with' => 'Sea starting price is required when Sea ending price is provided',
            'sea_price_end.required_with' => 'Sea ending price is required when Sea starting price is provided',
            'sea_price_end.gte' => 'Sea ending price must be greater than or equal to starting price',
            'air_price_start.required_without' => 'Either Sea or Air price is required',
            'air_price_start.required_with' => 'Air starting price is required when Air ending price is provided',
            'air_price_end.required_with' => 'Air ending price is required when Air starting price is provided',
            'air_price_end.gte' => 'Air ending price must be greater than or equal to starting price',
        ];
    }
}
