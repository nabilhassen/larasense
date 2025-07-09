<?php

declare(strict_types=1);

use App\Livewire\Auth\Login;
use App\Livewire\Auth\LogoutButton;
use App\Models\User;
use Livewire\Livewire;

test('login screen can be rendered', function () {
    Livewire::test(Login::class)
        ->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $component = Livewire::test(Login::class)
        ->set('form.email', $user->email)
        ->set('form.password', 'password');

    $component->call('login');

    $component
        ->assertHasNoErrors()
        ->assertRedirect(route('materials.index', absolute: false));

    $this->assertAuthenticated();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $component = Livewire::test(Login::class)
        ->set('form.email', $user->email)
        ->set('form.password', 'wrong-password');

    $component->call('login');

    $component
        ->assertHasErrors()
        ->assertNoRedirect();

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Livewire::test(LogoutButton::class);

    $component->call('logout');

    $component
        ->assertHasNoErrors()
        ->assertRedirect(route('login'));

    $this->assertGuest();
});
