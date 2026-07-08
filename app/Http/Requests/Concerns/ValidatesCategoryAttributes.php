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
            'price_start' => 'required|numeric|min:0',
            'price_end' => 'required|numeric|gt:price_start',
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function categoryAttributeMessages(): array
    {
        return [
            'name.required' => 'Category name is required',
            'price_start.required' => 'Starting price is required',
            'price_end.required' => 'Ending price is required',
            'price_end.gt' => 'Ending price must be greater than starting price',
        ];
    }
}
