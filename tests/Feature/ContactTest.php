<?php

use App\Models\Contact;

test('contact page is accessible', function () {
    $response = $this->get('/contact');

    $response->assertStatus(200);
    $response->assertSee('Contact Us');
});

test('contact form validation works', function () {
    $response = $this->post('/contact', []);

    $response->assertSessionHasErrors(['name', 'email', 'message']);
});

test('contact form can be submitted', function () {
    $response = $this->post('/contact', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'message' => 'Hello, this is a test message with at least ten characters.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Thank you for contacting us! We will get back to you soon.');

    $this->assertDatabaseHas('contacts', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'message' => 'Hello, this is a test message with at least ten characters.',
    ]);
});

test('contact page shows global validation errors when redirected with errors', function () {
    $response = $this->from('/contact')->followingRedirects()->post('/contact', [
        'name' => '',
        'email' => 'invalid-email',
        'message' => 'short',
    ]);

    $response->assertSee('There were some problems with your submission:');
    $response->assertSee('The name field is required.');
    $response->assertSee('The email field must be a valid email address.');
    $response->assertSee('The message field must be at least 10 characters.');
});

test('contact form handles database exceptions gracefully', function () {
    Contact::creating(function () {
        throw new Exception('Database error');
    });

    $response = $this->post('/contact', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'message' => 'Hello, this is a test message with at least ten characters.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('error', 'An error occurred while sending your message. Please try again later.');
});

test('contact page shows session error when redirected with error', function () {
    Contact::creating(function () {
        throw new Exception('Database error');
    });

    $response = $this->from('/contact')->followingRedirects()->post('/contact', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'message' => 'Hello, this is a test message with at least ten characters.',
    ]);

    $response->assertSee('An error occurred while sending your message. Please try again later.');
});
