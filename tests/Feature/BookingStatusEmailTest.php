<?php

use App\Enums\UserRole;
use App\Mail\BookingStatusChangedMail;
use App\Models\Booking;
use App\Models\Category;
use App\Models\District;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

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

test('changing booking status triggers booking status changed email to customer', function () {
    Mail::fake();

    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => bcrypt('password'),
        'role' => UserRole::Customer,
    ]);

    $booking = createTestBooking($user);

    // Initial creation doesn't trigger "updated" status changes
    Mail::assertNotSent(BookingStatusChangedMail::class);

    // Act: update status
    $booking->update([
        'status' => 'received_in_china',
    ]);

    // Assert: Email was sent
    Mail::assertSent(BookingStatusChangedMail::class, function ($mail) use ($user, $booking) {
        return $mail->hasTo($user->email) &&
               $mail->booking->id === $booking->id &&
               $mail->booking->status === 'received_in_china';
    });
});

test('booking status change does not attempt email sending if user has no email', function () {
    Mail::fake();

    $user = User::create([
        'name' => 'Phone Only User',
        'email' => null, // phone-only customer
        'password' => bcrypt('password'),
        'role' => UserRole::Customer,
    ]);

    $booking = createTestBooking($user);

    // Act: update status
    $booking->update([
        'status' => 'received_in_china',
    ]);

    // Assert: No emails were sent
    Mail::assertNothingSent();
});
