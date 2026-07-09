<?php

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
        'message' => 'Hello, this is a test message with at least ten characters.'
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Thank you for contacting us! We will get back to you soon.');

    $this->assertDatabaseHas('contacts', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'message' => 'Hello, this is a test message with at least ten characters.'
    ]);
});
