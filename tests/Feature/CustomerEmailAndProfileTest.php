<?php

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('requesting OTP for a new customer user with email saves the email', function () {
    $response = $this->post(route('customer.login.otp'), [
        'phone_number' => '01700000000',
        'email' => 'customer_new@example.com',
    ]);

    $response->assertSessionHasNoErrors();

    $user = User::where('phone_number', '01700000000')->first();
    expect($user)->not->toBeNull();
    expect($user->email)->toBe('customer_new@example.com');
});

test('requesting OTP for an existing customer without email updates their email', function () {
    $user = User::create([
        'name' => 'Existing Customer',
        'phone_number' => '01700000001',
        'role' => UserRole::Customer,
        'email' => null,
    ]);

    $response = $this->post(route('customer.login.otp'), [
        'phone_number' => '01700000001',
        'email' => 'customer_updated@example.com',
    ]);

    $response->assertSessionHasNoErrors();
    expect($user->fresh()->email)->toBe('customer_updated@example.com');
});

test('customer can update their email via profile update', function () {
    $user = User::create([
        'name' => 'Alice',
        'phone_number' => '01700000002',
        'role' => UserRole::Customer,
        'email' => 'alice@example.com',
    ]);

    $response = $this->actingAs($user, 'customer')
        ->patch(route('profile.update'), [
            'name' => 'Alice Updated',
            'email' => 'alice_new@example.com',
            'customer_code' => 'TP-1001',
        ]);

    $response->assertRedirect(route('profile.edit'));
    expect($user->fresh()->email)->toBe('alice_new@example.com');
    expect($user->fresh()->name)->toBe('Alice Updated');
});
