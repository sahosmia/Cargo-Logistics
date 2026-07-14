<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@cargo.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
            ]
        );
        $superAdmin->assignRole('Super Admin');

        // China Warehouse Manager
        $chinaManager = User::updateOrCreate(
            ['email' => 'china@cargo.com'],
            [
                'name' => 'China Manager',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
        $chinaManager->assignRole('China Warehouse Manager');

        // BD Warehouse Manager
        $bdManager = User::updateOrCreate(
            ['email' => 'bd@cargo.com'],
            [
                'name' => 'BD Manager',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
        $bdManager->assignRole('BD Warehouse Manager');

        // Sample Customer
        User::updateOrCreate(
            ['phone_number' => '01700000000'],
            [
                'name' => 'Sample Customer',
                'role' => 'customer',
                'customer_code' => 'TP-1001',
            ]
        );
    }
}
