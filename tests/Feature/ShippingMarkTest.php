<?php

use App\Models\Shipment;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('creating a user automatically generates a unique incremental customer code', function () {
    // Assert first user gets CVS-1001
    $user1 = User::create([
        'name' => 'Alice',
        'email' => 'alice@example.com',
        'password' => bcrypt('password'),
    ]);

    expect($user1->customer_code)->toBe('CVS-1001');

    // Assert second user gets CVS-1002
    $user2 = User::create([
        'name' => 'Bob',
        'email' => 'bob@example.com',
        'password' => bcrypt('password'),
    ]);

    expect($user2->customer_code)->toBe('CVS-1002');
});

test('user creation respects manually provided customer code', function () {
    $user = User::create([
        'name' => 'Charlie',
        'email' => 'charlie@example.com',
        'password' => bcrypt('password'),
        'customer_code' => 'CUSTOM-999',
    ]);

    expect($user->customer_code)->toBe('CUSTOM-999');

    // Next automatic code should not collide or be affected
    $user2 = User::create([
        'name' => 'David',
        'email' => 'david@example.com',
        'password' => bcrypt('password'),
    ]);

    expect($user2->customer_code)->toBe('CVS-1001');
});

test('creating a shipment automatically generates a unique shipping mark with current date', function () {
    $user = User::create([
        'name' => 'Alice',
        'email' => 'alice@example.com',
        'password' => bcrypt('password'),
    ]);

    $dateStr = now()->format('ymd');

    // First shipment
    $shipment1 = Shipment::create([
        'user_id' => $user->id,
    ]);

    expect($shipment1->shipping_mark)->toBe("CVS-1001-{$dateStr}");

    // Second shipment on same day for same user should append serial suffix
    $shipment2 = Shipment::create([
        'user_id' => $user->id,
    ]);

    expect($shipment2->shipping_mark)->toBe("CVS-1001-{$dateStr}-1");

    // Third shipment on same day for same user
    $shipment3 = Shipment::create([
        'user_id' => $user->id,
    ]);

    expect($shipment3->shipping_mark)->toBe("CVS-1001-{$dateStr}-2");
});

test('creating a shipment generates customer code for old user without customer code', function () {
    // Disable the observer momentarily to simulate an old user without code
    User::flushEventListeners();

    $user = User::create([
        'name' => 'Old User',
        'email' => 'old@example.com',
        'password' => bcrypt('password'),
    ]);

    expect($user->customer_code)->toBeNull();

    // Re-enable/re-register observer
    User::observe(UserObserver::class);

    $dateStr = now()->format('ymd');

    $shipment = Shipment::create([
        'user_id' => $user->id,
    ]);

    // The observer should generate user's code on the fly and update user
    $user->refresh();
    expect($user->customer_code)->toBe('CVS-1001');
    expect($shipment->shipping_mark)->toBe("CVS-1001-{$dateStr}");
});
