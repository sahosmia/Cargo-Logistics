<?php

use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\Category;
use App\Models\District;
use App\Models\User;
use App\Notifications\BookingCreatedNotification;
use App\Notifications\BookingStatusChangedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

function createTestBooking($user)
{
    $category = Category::create([
        'name' => 'Test '.uniqid(),
        'sea_price_start' => 10,
        'sea_price_end' => 20,
        'air_price_start' => 15,
        'air_price_end' => 25,
    ]);
    $district = District::create([
        'name' => 'Dhaka '.uniqid(),
        'code' => 'DHK'.uniqid(),
    ]);

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

test('changing booking status triggers booking status changed notification to customer', function () {
    Notification::fake();

    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => bcrypt('password'),
        'role' => UserRole::Customer,
    ]);

    $booking = createTestBooking($user);

    // Initial creation triggers created notification
    Notification::assertSentTo(
        $user,
        BookingCreatedNotification::class,
        function ($notification) use ($booking) {
            return $notification->booking->id === $booking->id;
        }
    );

    // Act: update status
    $booking->update([
        'status' => 'received_in_china',
    ]);

    // Assert: status changed Notification was sent
    Notification::assertSentTo(
        $user,
        BookingStatusChangedNotification::class,
        function ($notification) use ($booking) {
            return $notification->booking->id === $booking->id &&
                   $notification->booking->status === 'received_in_china';
        }
    );
});

test('booking created notification triggers on booking creation', function () {
    Notification::fake();

    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => bcrypt('password'),
        'role' => UserRole::Customer,
    ]);

    $booking = createTestBooking($user);

    Notification::assertSentTo(
        $user,
        BookingCreatedNotification::class,
        function ($notification) use ($booking) {
            return $notification->booking->id === $booking->id;
        }
    );
});
