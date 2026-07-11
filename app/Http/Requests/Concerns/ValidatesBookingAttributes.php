<?php

namespace App\Http\Requests\Concerns;

trait ValidatesBookingAttributes
{
    /**
     * @return array<string, mixed>
     */
    protected function bookingStoreRules(): array
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

    /**
     * @return array<string, mixed>
     */
    protected function bookingUpdateStatusRules(): array
    {
        return [
            'status' => 'required|string',
            'comment' => 'nullable|string',
            'total_weight' => 'nullable|numeric|min:0',
            'unit_price' => 'nullable|numeric|min:0',
            'total_price' => 'nullable|numeric|min:0',
            'payment_status' => 'nullable|string|in:pending,paid',
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function bookingAttributeMessages(): array
    {
        return [
            'method.required' => 'Shipping method is required',
            'tracking.required' => 'At least one tracking number is required',
            'item_name.required' => 'Item name is required',
            'category_id.required' => 'Category is required',
            'total_carton.required' => 'Total carton count is required',
            'total_quantity.required' => 'Total quantity is required',
            'total_weight.required' => 'Total weight is required',
            'delivery_method.required' => 'Delivery method is required',
            'district_id.required' => 'District is required',
            'address.required' => 'Delivery address is required',
        ];
    }
}
