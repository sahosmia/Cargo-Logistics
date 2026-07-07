<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Settings;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'app_name' => 'Crystal Vision Solutions',
            'email' => 'crystalsolutionsbd@gmail.com',
            'phone' => '01730-495650',
            'address' => 'Tower 71, Level-8, Near ECB Circle, Dhaka Cantonment, Dhaka-1206',
            'website_url' => 'http://www.crystalcomputers.com.bd',
            'paginated_quantity' => '10',
        ];

        foreach ($settings as $key => $value) {
            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
