<?php

declare(strict_types=1);

use App\Livewire\Profile\UploadProfilePicture;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

test('user can upload a profile picture', function () {
    $user = User::factory()->create();
    Storage::fake();

    Livewire::actingAs($user)
        ->test(UploadProfilePicture::class)
        ->set('file', UploadedFile::fake()->image('photo1.jpg'))
        ->call('validateUploadedFile')
        ->assertReturned(true)
        ->assertDispatched('update-user-profile-picture');

    Storage::disk('public')->assertExists($user->fresh()->avatar_url);

    expect($user->avatar)->not->toBe($user->refresh()->avatar);
});

test('user cannot upload unsupported mimetypes profile picture', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(UploadProfilePicture::class)
        ->set('file', UploadedFile::fake()->create('photo1.svg', mimeType: 'svg'))
        ->call('validateUploadedFile')
        ->assertHasErrors('file');
});

test('user can remove a profile picture', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(UploadProfilePicture::class)
        ->set('file', null)
        ->call('validateUploadedFile')
        ->assertReturned(true)
        ->assertDispatched('update-user-profile-picture');

    expect($user->avatar)->not->toBe($user->refresh()->avatar);
    expect($user->avatar_url)->toBeNull();
});
