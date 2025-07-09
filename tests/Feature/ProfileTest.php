<?php

declare(strict_types=1);

use App\Livewire\Profile\DeleteUserForm;
use App\Livewire\Profile\UpdateProfileInformationForm;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create()->refresh();

    $this->actingAs($this->user);
});

test('profile page is displayed', function () {
    $this->actingAs($this->user);

    $response = $this->get(route('settings'));

    $response
        ->assertStatus(200)
        ->assertSeeInOrder([
            'Profile Information',
            'Update Password',
            'Delete Account',
        ]);
});

test('profile information can be updated', function () {
    Livewire::actingAs($this->user)
        ->test(UpdateProfileInformationForm::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->call('updateProfileInformation')
        ->assertHasNoErrors()
        ->assertNoRedirect();

    $this->user->refresh();

    $this->assertSame('Test User', $this->user->name);
    $this->assertSame('test@example.com', $this->user->email);
    $this->assertNull($this->user->email_verified_at);
});

test('email verification status is unchanged when the email address is unchanged', function () {
    Livewire::actingAs($this->user)
        ->test(UpdateProfileInformationForm::class)
        ->set('name', 'Test User')
        ->set('email', $this->user->email)
        ->call('updateProfileInformation')
        ->assertHasNoErrors()
        ->assertNoRedirect();

    $this->assertNotNull($this->user->refresh()->email_verified_at);
});

test('user can delete their account', function () {
    $component = Livewire::actingAs($this->user)
        ->test(DeleteUserForm::class)
        ->set('password', 'password')
        ->call('deleteUser')
        ->assertHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    $this->assertNull($this->user->fresh());
});

test('correct password must be provided to delete account', function () {
    Livewire::actingAs($this->user)
        ->test('profile.delete-user-form')
        ->set('password', 'wrong-password')
        ->call('deleteUser')
        ->assertHasErrors('password')
        ->assertNoRedirect();

    $this->assertNotNull($this->user->fresh());
});
