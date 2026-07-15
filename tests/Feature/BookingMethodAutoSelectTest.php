<?php

use App\Models\User;

test('booking form auto selects method from query parameter', function () {
    $user = User::factory()->create(['role' => 'customer']);

    // Test with method=sea
    $response = $this->actingAs($user)->get('/booking?method=sea');
    $response->assertStatus(200);
    $response->assertSee('<option value="Sea" selected>Sea Cargo</option>', false);

    // Test with method=air
    $response = $this->actingAs($user)->get('/booking?method=air');
    $response->assertStatus(200);
    $response->assertSee('<option value="Air" selected>Air Shipping</option>', false);
});
