<?php

declare(strict_types=1);

use App\Livewire\UserAvatar;
use App\Models\User;
use Livewire\Livewire;

test('user avatar is pulled from ui-avatars if user has no an avatar', function () {
    $user = User::factory()->create(['avatar_url' => null]);

    Livewire::actingAs($user)
        ->test(UserAvatar::class)
        ->assertSeeHtmlInOrder([
            'ui-avatars.com',
            ...str($user->name)->squish()->words(2, '')->explode(' ')->toArray(),
        ]);
});

test('user avatar changes when the avatar is updated', function () {
    $user = User::factory()->create();

    $component = Livewire::actingAs($user)
        ->test(UserAvatar::class)
        ->assertSee($user->avatar);

    $newImage = fake()->imageUrl();
    $user->avatar_url = $newImage;
    $user->save();
    $user->refresh();

    $component
        ->refresh()
        ->assertSee($newImage);
});
