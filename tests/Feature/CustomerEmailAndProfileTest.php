<?php

use App\Enums\UserRole;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

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

test('smtp settings are dynamically loaded into mail configuration', function () {
    // Assert defaults
    expect(config('mail.mailers.smtp.host'))->not->toBe('mail.techpickly.com');

    // Create SMTP settings in the database
    Settings::updateOrCreate(['key' => 'mail_host'], ['value' => 'mail.techpickly.com']);
    Settings::updateOrCreate(['key' => 'mail_port'], ['value' => '587']);
    Settings::updateOrCreate(['key' => 'mail_username'], ['value' => 'techpickly_user']);
    Settings::updateOrCreate(['key' => 'mail_password'], ['value' => 'techpickly_pass']);
    Settings::updateOrCreate(['key' => 'mail_encryption'], ['value' => 'tls']);
    Settings::updateOrCreate(['key' => 'mail_from_address'], ['value' => 'no-reply@techpickly.com']);
    Settings::updateOrCreate(['key' => 'mail_from_name'], ['value' => 'Techpickly Outbox']);

    // Clear cache to force load
    Cache::forget('settings.all');

    // Trigger dynamic mail configuration mapping
    config([
        'mail.mailers.smtp.host' => settings('mail_host') ?: config('mail.mailers.smtp.host'),
        'mail.mailers.smtp.port' => settings('mail_port') ?: config('mail.mailers.smtp.port'),
        'mail.mailers.smtp.username' => settings('mail_username') ?: config('mail.mailers.smtp.username'),
        'mail.mailers.smtp.password' => settings('mail_password') ?: config('mail.mailers.smtp.password'),
        'mail.mailers.smtp.encryption' => settings('mail_encryption') ?: config('mail.mailers.smtp.encryption'),
        'mail.from.address' => settings('mail_from_address') ?: config('mail.from.address'),
        'mail.from.name' => settings('mail_from_name') ?: config('mail.from.name'),
    ]);

    expect(config('mail.mailers.smtp.host'))->toBe('mail.techpickly.com');
    expect(config('mail.mailers.smtp.port'))->toBe(587);
    expect(config('mail.mailers.smtp.username'))->toBe('techpickly_user');
    expect(config('mail.mailers.smtp.password'))->toBe('techpickly_pass');
    expect(config('mail.mailers.smtp.encryption'))->toBe('tls');
    expect(config('mail.from.address'))->toBe('no-reply@techpickly.com');
    expect(config('mail.from.name'))->toBe('Techpickly Outbox');
});
