<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\BookingHistory;
use App\Models\Category;
use App\Models\District;
use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingLifecycleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
    }

    public function test_super_admin_can_update_any_status_linearly()
    {
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('Super Admin');

        $booking = $this->createBooking();

        $this->actingAs($superAdmin)
            ->patch(route('bookings.update-status', $booking), [
                'status' => 'received_in_china',
                'comment' => 'Received'
            ])
            ->assertRedirect();

        $this->assertEquals('received_in_china', $booking->fresh()->status);
        $this->assertDatabaseHas('booking_histories', [
            'booking_id' => $booking->id,
            'status' => 'received_in_china',
            'comment' => 'Received'
        ]);
    }

    public function test_china_manager_can_only_update_china_statuses()
    {
        $chinaManager = User::factory()->create();
        $chinaManager->assignRole('China Warehouse Manager');

        $booking = $this->createBooking();

        // Allowed
        $this->actingAs($chinaManager)
            ->patch(route('bookings.update-status', $booking), ['status' => 'received_in_china'])
            ->assertRedirect();

        $booking = $booking->fresh();

        // Not Allowed (BD Status)
        $this->actingAs($chinaManager)
            ->patch(route('bookings.update-status', $booking), ['status' => 'arrived_in_bd'])
            ->assertStatus(403);
    }

    public function test_bd_manager_can_only_update_bd_statuses()
    {
        $bdManager = User::factory()->create();
        $bdManager->assignRole('BD Warehouse Manager');

        $booking = $this->createBooking();
        $booking->update(['status' => 'in_transit']);

        // Allowed
        $this->actingAs($bdManager)
            ->patch(route('bookings.update-status', $booking), ['status' => 'arrived_in_bd'])
            ->assertRedirect();

        // Not Allowed (China Status - already passed but testing permission)
        $booking->update(['status' => 'pending']);
        $this->actingAs($bdManager)
            ->patch(route('bookings.update-status', $booking), ['status' => 'received_in_china'])
            ->assertStatus(403);
    }

    public function test_linear_lifecycle_is_enforced()
    {
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('Super Admin');

        $booking = $this->createBooking();

        // Try to skip to Arrived in BD from Pending (Not Allowed)
        $this->actingAs($superAdmin)
            ->patch(route('bookings.update-status', $booking), ['status' => 'arrived_in_bd'])
            ->assertStatus(403);
    }

    private function createBooking()
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Test', 'price_start' => 10, 'price_end' => 20]);
        $district = District::create(['name' => 'Dhaka', 'code' => 'DHK']);

        return Booking::create([
            'user_id' => $user->id,
            'item_name' => 'Test Item',
            'category_id' => $category->id,
            'method' => 'air',
            'tracking' => ['123'],
            'total_carton' => 1,
            'total_quantity' => 1,
            'total_weight' => 1.0,
            'delivery_method' => 'courier',
            'district_id' => $district->id,
            'address' => 'Dhaka',
            'status' => 'pending'
        ]);
    }
}
