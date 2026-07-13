<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can create a category with both sea and air prices', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($admin)
        ->post(route('categories.store'), [
            'name' => 'Full Pricing Category',
            'sea_price_start' => 150,
            'sea_price_end' => 200,
            'air_price_start' => 500,
            'air_price_end' => 600,
        ]);

    $response->assertRedirect(route('categories.index'));
    $this->assertDatabaseHas('categories', [
        'name' => 'Full Pricing Category',
        'sea_price_start' => 150.00,
        'sea_price_end' => 200.00,
        'air_price_start' => 500.00,
        'air_price_end' => 600.00,
    ]);
});

test('admin can create a category with only sea prices', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($admin)
        ->post(route('categories.store'), [
            'name' => 'Sea Only Category',
            'sea_price_start' => 150,
            'sea_price_end' => 200,
            'air_price_start' => null,
            'air_price_end' => null,
        ]);

    $response->assertRedirect(route('categories.index'));
    $this->assertDatabaseHas('categories', [
        'name' => 'Sea Only Category',
        'sea_price_start' => 150.00,
        'sea_price_end' => 200.00,
        'air_price_start' => null,
        'air_price_end' => null,
    ]);
});

test('admin can create a category with only air prices', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($admin)
        ->post(route('categories.store'), [
            'name' => 'Air Only Category',
            'sea_price_start' => null,
            'sea_price_end' => null,
            'air_price_start' => 450,
            'air_price_end' => 550,
        ]);

    $response->assertRedirect(route('categories.index'));
    $this->assertDatabaseHas('categories', [
        'name' => 'Air Only Category',
        'sea_price_start' => null,
        'sea_price_end' => null,
        'air_price_start' => 450.00,
        'air_price_end' => 550.00,
    ]);
});

test('category validation fails if starting price is given without ending price', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($admin)
        ->from(route('categories.create'))
        ->post(route('categories.store'), [
            'name' => 'Invalid Category',
            'sea_price_start' => 150,
            'sea_price_end' => null,
        ]);

    $response->assertSessionHasErrors(['sea_price_end']);
});

test('category validation fails if ending price is given without starting price', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($admin)
        ->from(route('categories.create'))
        ->post(route('categories.store'), [
            'name' => 'Invalid Category',
            'sea_price_start' => null,
            'sea_price_end' => 200,
        ]);

    $response->assertSessionHasErrors(['sea_price_start']);
});

test('category validation fails if no prices are specified', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($admin)
        ->from(route('categories.create'))
        ->post(route('categories.store'), [
            'name' => 'No Price Category',
            'sea_price_start' => null,
            'sea_price_end' => null,
            'air_price_start' => null,
            'air_price_end' => null,
        ]);

    $response->assertSessionHasErrors(['sea_price_start', 'air_price_start']);
});

test('search-categories API returns filtered categories based on transport method parameter', function () {
    // Create 3 categories:
    // 1. Sea Only
    Category::create([
        'name' => 'Sea Goods',
        'sea_price_start' => 100,
        'sea_price_end' => 150,
        'air_price_start' => null,
        'air_price_end' => null,
    ]);

    // 2. Air Only
    Category::create([
        'name' => 'Air Goods',
        'sea_price_start' => null,
        'sea_price_end' => null,
        'air_price_start' => 400,
        'air_price_end' => 500,
    ]);

    // 3. Both
    Category::create([
        'name' => 'Universal Goods',
        'sea_price_start' => 120,
        'sea_price_end' => 160,
        'air_price_start' => 450,
        'air_price_end' => 550,
    ]);

    // No method filter: returns all 3
    $response = $this->getJson(route('api.search-categories'));
    $response->assertOk();
    $data = $response->json();
    expect(count($data))->toBe(3);

    // Method = sea: returns 'Sea Goods' and 'Universal Goods'
    $response = $this->getJson(route('api.search-categories', ['method' => 'sea']));
    $response->assertOk();
    $data = $response->json();
    expect(count($data))->toBe(2);
    $names = collect($data)->pluck('name')->all();
    expect($names)->toContain('Sea Goods');
    expect($names)->toContain('Universal Goods');
    expect($names)->not->toContain('Air Goods');

    // Method = air: returns 'Air Goods' and 'Universal Goods'
    $response = $this->getJson(route('api.search-categories', ['method' => 'air']));
    $response->assertOk();
    $data = $response->json();
    expect(count($data))->toBe(2);
    $names = collect($data)->pluck('name')->all();
    expect($names)->toContain('Air Goods');
    expect($names)->toContain('Universal Goods');
    expect($names)->not->toContain('Sea Goods');
});

test('accessing non-existent URL returns custom 404 page', function () {
    $response = $this->get('/non-existent-page-url-123');

    $response->assertStatus(404);
    $response->assertSee('Oops! Page Not Found');
    $response->assertSee('The page you are looking for might have been removed');
});
