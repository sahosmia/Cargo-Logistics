<?php

use App\Models\Settings;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    Cache::forget('settings.all');
});

test('guest can access the privacy policy page and see correct content', function () {
    Settings::updateOrCreate(['key' => 'privacy_policy'], ['value' => 'This is the dynamic privacy policy content.']);
    Cache::forget('settings.all');

    $response = $this->get(route('privacy.policy'));

    $response->assertStatus(200);
    $response->assertSee('This is the dynamic privacy policy content.');
    $response->assertSee('Privacy Policy');
});

test('guest can access the return & refund policy page and see correct content', function () {
    Settings::updateOrCreate(['key' => 'return_refund'], ['value' => 'This is the dynamic return and refund policy.']);
    Cache::forget('settings.all');

    $response = $this->get(route('return.refund'));

    $response->assertStatus(200);
    $response->assertSee('This is the dynamic return and refund policy.');
    $response->assertSee('Return & Refund Policy', false);
});

test('guest can access the terms & conditions page and see correct content', function () {
    Settings::updateOrCreate(['key' => 'terms_conditions'], ['value' => 'This is the dynamic terms and conditions.']);
    Cache::forget('settings.all');

    $response = $this->get(route('terms.conditions'));

    $response->assertStatus(200);
    $response->assertSee('This is the dynamic terms and conditions.');
    $response->assertSee('Terms & Conditions', false);
});

test('authorized users (admins) can update the settings for policy pages', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('admin.settings.update'), [
            'app_name' => 'Techpickly Updated',
            'paginated_quantity' => 20,
            'privacy_policy' => 'Newly updated privacy policy!',
            'return_refund' => 'Newly updated return & refund!',
            'terms_conditions' => 'Newly updated terms & conditions!',
        ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect();

    Cache::forget('settings.all');

    expect(settings('privacy_policy'))->toBe('Newly updated privacy policy!');
    expect(settings('return_refund'))->toBe('Newly updated return & refund!');
    expect(settings('terms_conditions'))->toBe('Newly updated terms & conditions!');
});
