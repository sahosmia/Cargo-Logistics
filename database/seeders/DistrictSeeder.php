<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            ['name' => 'Barisal', 'code' => 'BAR', 'status' => 1],
            ['name' => 'Chittagong', 'code' => 'CHI', 'status' => 1],
            ['name' => 'Dhaka', 'code' => 'DHK', 'status' => 1],
            ['name' => 'Khulna', 'code' => 'KHU', 'status' => 1],
            ['name' => 'Rajshahi', 'code' => 'RAJ', 'status' => 1],
            ['name' => 'Sylhet', 'code' => 'SYL', 'status' => 1],
            ['name' => 'Rangpur', 'code' => 'RNG', 'status' => 1],
            ['name' => 'Mymensingh', 'code' => 'MNS', 'status' => 1],
            ['name' => 'Gazipur', 'code' => '', 'status' => 1],
            ['name' => 'Narayanganj', 'code' => 'NGJ', 'status' => 1],
            ['name' => 'Savar', 'code' => 'SVR', 'status' => 1],
            ['name' => 'Faridpur', 'code' => '', 'status' => 1],
            ['name' => 'Gopalganj', 'code' => '', 'status' => 1],
            ['name' => 'Kishorganj', 'code' => '', 'status' => 1],
            ['name' => 'Madaripur', 'code' => '', 'status' => 1],
            ['name' => 'Manikganj', 'code' => '', 'status' => 1],
            ['name' => 'Munshiganj', 'code' => '', 'status' => 1],
            ['name' => 'Narshingdi', 'code' => '', 'status' => 1],
            ['name' => 'Rajbari', 'code' => '', 'status' => 1],
            ['name' => 'Shariatpur', 'code' => '', 'status' => 1],
            ['name' => 'Tangail', 'code' => '', 'status' => 1],
            ['name' => 'Jamalpur', 'code' => '', 'status' => 1],
            ['name' => 'Netrokona', 'code' => '', 'status' => 1],
            ['name' => 'Sherpur', 'code' => '', 'status' => 1],
            ['name' => 'Bagerhat', 'code' => '', 'status' => 1],
            ['name' => 'Chuadanga', 'code' => '', 'status' => 1],
            ['name' => 'Jessore', 'code' => '', 'status' => 1],
            ['name' => 'Jhenaidah', 'code' => '', 'status' => 1],
            ['name' => 'Kustia', 'code' => '', 'status' => 1],
            ['name' => 'Magura', 'code' => '', 'status' => 1],
            ['name' => 'Narail', 'code' => '', 'status' => 1],
            ['name' => 'Satkhira', 'code' => '', 'status' => 1],
            ['name' => 'Bogura', 'code' => '', 'status' => 1],
            ['name' => 'Chapai Nawabganj', 'code' => '', 'status' => 1],
            ['name' => 'Joypur Hat', 'code' => '', 'status' => 1],
            ['name' => 'Naoga', 'code' => '', 'status' => 1],
            ['name' => 'Natore', 'code' => '', 'status' => 1],
            ['name' => 'Pabna', 'code' => '', 'status' => 1],
            ['name' => 'Sirajganj', 'code' => '', 'status' => 1],
            ['name' => 'Habiganj', 'code' => '', 'status' => 1],
            ['name' => 'Moulvibazar', 'code' => '', 'status' => 1],
            ['name' => 'Sunamganj', 'code' => '', 'status' => 1],
            ['name' => 'Barguna', 'code' => '', 'status' => 1],
            ['name' => 'Bhola', 'code' => '', 'status' => 1],
            ['name' => 'Jhalokathi', 'code' => '', 'status' => 1],
            ['name' => 'Patuakhali', 'code' => '', 'status' => 1],
            ['name' => 'Perojpur', 'code' => '', 'status' => 1],
            ['name' => 'Bandarban', 'code' => '', 'status' => 1],
            ['name' => 'Brahmanbaria', 'code' => '', 'status' => 1],
            ['name' => 'Chandpur', 'code' => '', 'status' => 1],
            ['name' => 'Comilla', 'code' => '', 'status' => 1],
            ['name' => 'Cox\'s Bazar', 'code' => '', 'status' => 1],
            ['name' => 'Feni', 'code' => '', 'status' => 1],
            ['name' => 'Khagrachari', 'code' => '', 'status' => 1],
            ['name' => 'Noakhali', 'code' => '', 'status' => 1],
            ['name' => 'Rangamati', 'code' => '', 'status' => 1],
            ['name' => 'Dinajpur', 'code' => '', 'status' => 1],
            ['name' => 'Gaibandha', 'code' => '', 'status' => 1],
            ['name' => 'Kurigram', 'code' => '', 'status' => 1],
            ['name' => 'Lalmonirhat', 'code' => '', 'status' => 1],
            ['name' => 'Nilphamari', 'code' => '', 'status' => 1],
            ['name' => 'Panchagarh', 'code' => '', 'status' => 1],
            ['name' => 'Thakurgaon', 'code' => '', 'status' => 1],
            ['name' => 'Lakshmipur', 'code' => '', 'status' => 1],
        ];

        foreach ($districts as $district) {
            District::create($district);
        }
    }
}
