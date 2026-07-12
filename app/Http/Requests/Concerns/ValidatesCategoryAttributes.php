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
            'sea_price_start' => 'required|numeric|min:0',
            'sea_price_end' => 'required|numeric|gte:sea_price_start',
            'air_price_start' => 'required|numeric|min:0',
            'air_price_end' => 'required|numeric|gte:air_price_start',
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function categoryAttributeMessages(): array
    {
        return [
            'name.required' => 'Category name is required',
            'sea_price_start.required' => 'Sea starting price is required',
            'sea_price_end.required' => 'Sea ending price is required',
            'sea_price_end.gte' => 'Sea ending price must be greater than or equal to starting price',
            'air_price_start.required' => 'Air starting price is required',
            'air_price_end.required' => 'Air ending price is required',
            'air_price_end.gte' => 'Air ending price must be greater than or equal to starting price',
        ];
    }
}
