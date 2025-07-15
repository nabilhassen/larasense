<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Livewire\Auth\Register;
use App\Models\User;
use App\Notifications\QueueableVerifyEmailNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

test('registration screen can be rendered', function () {
    Livewire::test(Register::class)
        ->assertStatus(200);
});

test('new users can register', function () {
    Notification::fake();

    Livewire::test(Register::class)
        ->set('name', 'Test User')
        ->set('email', 'test@larasense.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register')
        ->assertRedirect(route('materials.index', absolute: false));

    Notification::assertSentTo(
        [User::firstWhere('email', 'test@larasense.com')],
        QueueableVerifyEmailNotification::class
    );

    $this->assertAuthenticated();
});
