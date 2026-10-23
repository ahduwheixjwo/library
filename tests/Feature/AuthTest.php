<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
    ]);

    $this->assertAuthenticated();
});

test('user cannot register with duplicate email', function () {
    User::factory()->create(['email' => 'duplicate@example.com']);

    $response = $this->post('/register', [
        'name' => 'Another User',
        'email' => 'duplicate@example.com',
        'password' => 'password123',
    ]);

    $response->assertSessionHasErrors('email');
});

test('user can login with correct credentials', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password123'),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password123',
    ]);

    $this->assertAuthenticatedAs($user);
});

test('user cannot login with wrong password', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password123'),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrongpassword',
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors('email');
});

test('user can logout', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/login');
});
