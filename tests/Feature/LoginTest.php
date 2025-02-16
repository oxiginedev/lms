<?php

declare(strict_types=1);

use App\Models\User;

test('login page can be displayed', function () {
    $response = $this->get('/login');

    $response->assertOk();
});

test('user can login with valid credentials', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();

    $response->assertRedirect('/dashboard');
});
