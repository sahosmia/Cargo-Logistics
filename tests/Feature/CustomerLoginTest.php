<?php

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;

test('customer can view login form', function () {
    $response = $this->get(route('customer.login'));

    $response->assertStatus(200);
});

test('customer can request OTP and new user is created', function () {
    $phone = '0123456789';

    $response = $this->post(route('customer.login.otp'), [
        'phone_number' => $phone,
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('users', [
        'phone_number' => $phone,
        'role' => UserRole::Customer->value,
    ]);

    $otp = Cache::get("otp_{$phone}");
    $this->assertNotNull($otp);
});

test('existing customer can request OTP', function () {
    $user = User::factory()->create([
        'phone_number' => '9876543210',
        'role' => UserRole::Customer,
    ]);

    $response = $this->post(route('customer.login.otp'), [
        'phone_number' => '9876543210',
    ]);

    $response->assertStatus(200);
    $this->assertCount(1, User::where('phone_number', '9876543210')->get());
});

test('customer can login with valid OTP', function () {
    $phone = '1112223333';
    $otp = '123456';

    $user = User::factory()->create([
        'phone_number' => $phone,
        'role' => UserRole::Customer,
    ]);

    Cache::put("otp_{$phone}", $otp, now()->addMinutes(5));

    $response = $this->post(route('customer.login.verify'), [
        'phone_number' => $phone,
        'otp' => $otp,
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertTrue(Auth::guard('customer')->check());
    $this->assertEquals($user->id, Auth::guard('customer')->id());
});

test('customer cannot login with invalid OTP', function () {
    $phone = '1112223333';

    User::factory()->create([
        'phone_number' => $phone,
        'role' => UserRole::Customer,
    ]);

    Cache::put("otp_{$phone}", '123456', now()->addMinutes(5));

    $response = $this->post(route('customer.login.verify'), [
        'phone_number' => $phone,
        'otp' => '654321',
    ]);

    $response->assertSessionHasErrors('otp');
    $this->assertFalse(Auth::guard('customer')->check());
});

test('otp verification is rate limited', function () {
    $phone = '4445556666';

    User::factory()->create([
        'phone_number' => $phone,
        'role' => UserRole::Customer,
    ]);

    Cache::put("otp_{$phone}", '123456', now()->addMinutes(5));

    for ($i = 0; $i < 5; $i++) {
        $this->post(route('customer.login.verify'), [
            'phone_number' => $phone,
            'otp' => '111111',
        ]);
    }

    $response = $this->post(route('customer.login.verify'), [
        'phone_number' => $phone,
        'otp' => '111111',
    ]);

    $response->assertSessionHasErrors('otp');
    $this->assertStringContainsString('Too many failed attempts', session('errors')->get('otp')[0]);
});
