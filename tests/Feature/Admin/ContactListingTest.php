<?php

use App\Models\Contact;
use App\Models\User;
use App\Enums\UserRole;

test('admin can view contact submissions', function () {
    $admin = User::factory()->create(['role' => UserRole::SuperAdmin]);
    $contact = Contact::create([
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'message' => 'Interested in your services.'
    ]);

    $response = $this->actingAs($admin)->get(route('admin.contacts.index'));

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page
        ->component('Admin/Contacts/Index')
        ->has('contacts.data', 1)
        ->where('contacts.data.0.name', 'Jane Doe')
    );
});

test('customer cannot view contact submissions', function () {
    $customer = User::factory()->create(['role' => UserRole::Customer]);

    $response = $this->actingAs($customer)->get(route('admin.contacts.index'));

    $response->assertStatus(403);
});

test('guest cannot view contact submissions', function () {
    $response = $this->get(route('admin.contacts.index'));

    $response->assertRedirect(route('login'));
});
