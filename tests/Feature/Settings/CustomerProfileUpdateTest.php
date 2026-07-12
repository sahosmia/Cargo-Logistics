<?php

use App\Models\User;

test('customer profile page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user, 'customer')
        ->get('/settings/profile');

    $response->assertOk();
});

test('customer profile information can be updated without email', function () {
    $user = User::factory()->create([
        'email' => 'old@example.com',
    ]);

    $response = $this
        ->actingAs($user, 'customer')
        ->patch('/settings/profile', [
            'name' => 'New Name',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/settings/profile');

    $user->refresh();

    expect($user->name)->toBe('New Name');
    expect($user->email)->toBe('old@example.com');
});

test('customer cannot access password settings', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user, 'customer')
        ->get('/settings/password');

    $response->assertRedirect('/settings/profile');
});

test('customer cannot update password', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user, 'customer')
        ->put('/settings/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response->assertRedirect('/settings/profile');
});
