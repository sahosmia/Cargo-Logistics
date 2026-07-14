<?php

namespace Tests\Feature;

use App\Models\Booking;
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
                'comment' => 'Received',
            ])
            ->assertRedirect();

        $this->assertEquals('received_in_china', $booking->fresh()->status);
        $this->assertDatabaseHas('booking_histories', [
            'booking_id' => $booking->id,
            'status' => 'received_in_china',
            'comment' => 'Received',
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

        // Allowed
        $this->actingAs($chinaManager)
            ->patch(route('bookings.update-status', $booking), ['status' => 'in_transit'])
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

    public function test_customer_can_view_own_booking_details()
    {
        $user = User::factory()->create();
        $booking = $this->createBookingForUser($user);

        $this->actingAs($user)
            ->get(route('bookings.show', $booking))
            ->assertOk();
    }

    public function test_customer_cannot_view_others_booking_details()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $booking = $this->createBookingForUser($user1);

        $this->actingAs($user2)
            ->get(route('bookings.show', $booking))
            ->assertStatus(403);
    }

    public function test_admin_with_permission_can_view_any_booking_details()
    {
        $admin = User::factory()->create();
        $admin->assignRole('Super Admin');
        $user = User::factory()->create();
        $booking = $this->createBookingForUser($user);

        $this->actingAs($admin)
            ->get(route('bookings.show', $booking))
            ->assertOk();
    }

    private function createBooking()
    {
        $user = User::factory()->create();

        return $this->createBookingForUser($user);
    }

    private function createBookingForUser($user)
    {
        $category = Category::create([
            'name' => 'Test '.uniqid(),
            'sea_price_start' => 10,
            'sea_price_end' => 20,
            'air_price_start' => 10,
            'air_price_end' => 20,
        ]);
        $district = District::create(['name' => 'Dhaka '.uniqid(), 'code' => 'DHK'.uniqid()]);

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
            'status' => 'pending',
        ]);
    }

    public function test_customer_can_view_own_booking_invoice()
    {
        $user = User::factory()->create();
        $booking = $this->createBookingForUser($user);

        $this->actingAs($user)
            ->get(route('bookings.invoice', $booking))
            ->assertOk();
    }

    public function test_customer_cannot_view_others_booking_invoice()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $booking = $this->createBookingForUser($user1);

        $this->actingAs($user2)
            ->get(route('bookings.invoice', $booking))
            ->assertStatus(403);
    }

    public function test_admin_with_permission_can_view_any_booking_invoice()
    {
        $admin = User::factory()->create();
        $admin->assignRole('Super Admin');
        $user = User::factory()->create();
        $booking = $this->createBookingForUser($user);

        $this->actingAs($admin)
            ->get(route('bookings.invoice', $booking))
            ->assertOk();
    }
}
