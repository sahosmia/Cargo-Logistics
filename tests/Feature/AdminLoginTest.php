<?php

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

test('admin can view login form', function () {
    $response = $this->get(route('login'));

    $response->assertStatus(200);
});

test('admin can login with credentials', function () {
    $password = 'password123';
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => bcrypt($password),
        'role' => UserRole::Admin,
    ]);

    $response = $this->post(route('login'), [
        'email' => 'admin@example.com',
        'password' => $password,
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertTrue(Auth::guard('web')->check());
    $this->assertEquals($admin->id, Auth::guard('web')->id());
});

test('admin cannot login with invalid credentials', function () {
    User::factory()->create([
        'email' => 'admin@example.com',
        'password' => bcrypt('password123'),
        'role' => UserRole::Admin,
    ]);

    $response = $this->post(route('login'), [
        'email' => 'admin@example.com',
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertFalse(Auth::guard('web')->check());
});
