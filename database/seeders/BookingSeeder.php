<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Category;
use App\Models\District;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = User::firstOrCreate(
            ['phone_number' => '01700000000'],
            [
                'name' => 'Sample Customer',
                'role' => 'customer',
                'customer_code' => 'CVS-1001',
            ]
        );

        $categories = Category::limit(3)->get();
        $districts = District::limit(3)->get();

        if ($categories->isEmpty() || $districts->isEmpty()) {
            return;
        }

        $dateStr = date('ymd');

        $dummyBookings = [
            [
                'item_name' => 'Premium Men\'s Perfume',
                'category_id' => $categories[0]->id,
                'method' => 'Air',
                'tracking' => ['TRK-8291048-A', 'TRK-8291048-B'],
                'total_carton' => 1,
                'total_quantity' => 12,
                'total_weight' => 2.50,
                'sensitive_goods' => true,
                'delivery_method' => 'Home Delivery',
                'district_id' => $districts[0]->id,
                'address' => 'House 42, Road 11, Banani, Dhaka',
                'note' => 'Handle with care. Fragile bottle.',
                'status' => 'pending',
                'shipping_mark' => "CVS-1001-{$dateStr}",
            ],
            [
                'item_name' => 'Cotton Printed T-shirts',
                'category_id' => $categories[min(1, $categories->count() - 1)]->id,
                'method' => 'Sea',
                'tracking' => ['TRK-1092837'],
                'total_carton' => 3,
                'total_quantity' => 150,
                'total_weight' => 45.00,
                'sensitive_goods' => false,
                'delivery_method' => 'Office Pickup',
                'district_id' => $districts[min(1, $districts->count() - 1)]->id,
                'address' => 'Sector 4, Uttara, Dhaka',
                'note' => 'Keep in dry storage.',
                'status' => 'received_in_china',
                'shipping_mark' => "CVS-1001-{$dateStr}-1",
            ],
            [
                'item_name' => 'Wired Gaming Keyboard',
                'category_id' => $categories[min(2, $categories->count() - 1)]->id,
                'method' => 'Air',
                'tracking' => ['TRK-5561022'],
                'total_carton' => 1,
                'total_quantity' => 5,
                'total_weight' => 4.20,
                'sensitive_goods' => false,
                'delivery_method' => 'Home Delivery',
                'district_id' => $districts[min(2, $districts->count() - 1)]->id,
                'address' => 'GEC Circle, Chittagong',
                'note' => null,
                'status' => 'delivered',
                'shipping_mark' => "CVS-1001-{$dateStr}-2",
            ],
        ];

        foreach ($dummyBookings as $bookingData) {
            Booking::create(array_merge([
                'user_id' => $customer->id,
            ], $bookingData));
        }
    }
}
