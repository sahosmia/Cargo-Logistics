<?php

namespace App\Http\Requests\Concerns;

trait ValidatesSettingsAttributes
{
    /**
     * @return array<string, mixed>
     */
    protected function settingsAttributeRules(): array
    {
        return [
            'site_logo' => ['nullable', 'image', 'max:2048'],
            'sidebar_logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'image', 'max:1024'],
            'hero_banner' => ['nullable', 'image', 'max:5120'],
            'app_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'warehouses' => ['nullable', 'string', 'max:255'],
            'office_hours' => ['nullable', 'string', 'max:255'],
            'paginated_quantity' => ['required', 'integer', 'min:1'],
            'privacy_policy' => ['nullable', 'string'],
            'return_refund' => ['nullable', 'string'],
            'terms_conditions' => ['nullable', 'string'],
            // 'mail_mailer' => ['nullable', 'string', 'max:255'],
            'mail_host' => ['nullable', 'string', 'max:255'],
            'mail_port' => ['nullable', 'integer'],
            'mail_username' => ['nullable', 'string', 'max:255'],
            'mail_password' => ['nullable', 'string', 'max:255'],
            'mail_encryption' => ['nullable', 'string', 'max:50'],
            'mail_from_address' => ['nullable', 'email', 'max:255'],
            'mail_from_name' => ['nullable', 'string', 'max:255'],
            'sms_enabled' => ['nullable', 'string', 'max:10'],
            'sms_api_url' => ['nullable', 'string', 'max:255'],
            'sms_api_key' => ['nullable', 'string', 'max:255'],
            'sms_sender_id' => ['nullable', 'string', 'max:50'],
            'china_warehouse_address' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function settingsAttributeMessages(): array
    {
        return [
            'app_name.required' => 'Application name is required',
            'paginated_quantity.required' => 'Pagination quantity is required',
            'paginated_quantity.integer' => 'Pagination quantity must be a valid integer',
        ];
    }
}
