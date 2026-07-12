<?php

use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\Category;
use App\Models\District;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function createBookingForUser($user)
{
    $category = Category::create([
        'name' => 'Test '.uniqid(),
        'price_start' => 10,
        'price_end' => 20,
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

test('creating a customer user automatically generates a unique incremental customer code', function () {
    // Assert customer user gets CVS-1001
    $user1 = User::create([
        'name' => 'Alice',
        'email' => 'alice@example.com',
        'password' => bcrypt('password'),
        'role' => UserRole::Customer,
    ]);

    expect($user1->customer_code)->toBe('CVS-1001');

    // Assert second customer user gets CVS-1002
    $user2 = User::create([
        'name' => 'Bob',
        'email' => 'bob@example.com',
        'password' => bcrypt('password'),
        'role' => UserRole::Customer,
    ]);

    expect($user2->customer_code)->toBe('CVS-1002');
});

test('non-customer user does not get customer code', function () {
    // Admin user
    $user = User::create([
        'name' => 'Charlie',
        'email' => 'charlie@example.com',
        'password' => bcrypt('password'),
        'role' => UserRole::Admin,
    ]);

    expect($user->customer_code)->toBeNull();
});

test('customer user creation respects manually provided customer code', function () {
    $user = User::create([
        'name' => 'Charlie',
        'email' => 'charlie@example.com',
        'password' => bcrypt('password'),
        'role' => UserRole::Customer,
        'customer_code' => 'CUSTOM-999',
    ]);

    expect($user->customer_code)->toBe('CUSTOM-999');

    // Next automatic code should not collide or be affected
    $user2 = User::create([
        'name' => 'David',
        'email' => 'david@example.com',
        'password' => bcrypt('password'),
        'role' => UserRole::Customer,
    ]);

    expect($user2->customer_code)->toBe('CVS-1001');
});

test('creating a booking for a customer user automatically generates a unique shipping mark with current date', function () {
    $user = User::create([
        'name' => 'Alice',
        'email' => 'alice@example.com',
        'password' => bcrypt('password'),
        'role' => UserRole::Customer,
    ]);

    $dateStr = now()->format('ymd');

    // First booking
    $booking1 = createBookingForUser($user);

    expect($booking1->shipping_mark)->toBe("CVS-1001-{$dateStr}");

    // Second booking on same day for same customer should append serial suffix
    $booking2 = createBookingForUser($user);

    expect($booking2->shipping_mark)->toBe("CVS-1001-{$dateStr}-1");

    // Third booking on same day for same customer
    $booking3 = createBookingForUser($user);

    expect($booking3->shipping_mark)->toBe("CVS-1001-{$dateStr}-2");
});

test('creating a booking for a non-customer user does not generate a shipping mark', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'role' => UserRole::Admin,
    ]);

    $booking = createBookingForUser($admin);

    expect($booking->shipping_mark)->toBeNull();
});

test('creating a booking generates customer code for old customer user without customer code', function () {
    // Disable the observer momentarily to simulate an old customer user without code
    User::flushEventListeners();

    $user = User::create([
        'name' => 'Old Customer',
        'email' => 'old@example.com',
        'password' => bcrypt('password'),
        'role' => UserRole::Customer,
    ]);

    expect($user->customer_code)->toBeNull();

    // Re-enable/re-register observer
    User::observe(UserObserver::class);

    $dateStr = now()->format('ymd');

    $booking = createBookingForUser($user);

    // The observer should generate user's code on the fly and update user
    $user->refresh();
    expect($user->customer_code)->toBe('CVS-1001');
    expect($booking->shipping_mark)->toBe("CVS-1001-{$dateStr}");
});
