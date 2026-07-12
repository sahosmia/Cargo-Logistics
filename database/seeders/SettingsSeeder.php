<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'app_name' => 'Techpickly',
            'email' => 'techpickly@gmail.com',
            'phone' => '01730-495650',
            'address' => 'Tower 71, Level-8, Near ECB Circle, Dhaka Cantonment, Dhaka-1206',
            'website_url' => 'http://www.techpickly.com.bd',
            'paginated_quantity' => '10',
        ];

        foreach ($settings as $key => $value) {
            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
