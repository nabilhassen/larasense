<?php

declare(strict_types=1);

use App\Livewire\Materials\Card;
use App\Models\Material;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);

    Material::factory()->create();

    $this->material = Material::firstOrFail();
});

test('material item is render successfully', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug);
});

test('material item views count can increment', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('viewed')
        ->call('viewed');

    expect($this->material->fresh()->views)->toBe(2);
});

test('material item expands count can increment', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('expanded')
        ->call('expanded');

    expect($this->material->fresh()->expands)->toBe(2);
});

test('material item redirects count can increment', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('redirected')
        ->call('redirected');

    expect($this->material->fresh()->redirects)->toBe(2);
});

test('material item plays count can increment', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('played')
        ->call('played');

    expect($this->material->fresh()->plays)->toBe(2);
});

test('user can like a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('like')
        ->assertSet('isLiked', true);
});

test('user can unlike a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('like')
        ->assertSet('isLiked', true)
        ->call('unlike')
        ->assertSet('isLiked', false);
});

test('user has liked one material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->assertSet('likesCount', 0)
        ->call('like')
        ->call('like')
        ->assertSet('likesCount', 1);
});

test('user can dislike a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('dislike')
        ->assertSet('isDisliked', true);
});

test('user can undislike a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('dislike')
        ->assertSet('isDisliked', true)
        ->call('undislike')
        ->assertSet('isDisliked', false);
});

test('user can like then dislike a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('like')
        ->assertSet('isLiked', true)
        ->assertSet('isDisliked', false)
        ->call('dislike')
        ->assertSet('isLiked', false)
        ->assertSet('isDisliked', true);
});

test('user can dislike then like a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('dislike')
        ->assertSet('isDisliked', true)
        ->assertSet('isLiked', false)
        ->call('like')
        ->assertSet('isDisliked', false)
        ->assertSet('isLiked', true);
});

test('user can bookmark a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->assertSet('isBookmarked', false)
        ->call('bookmark')
        ->assertSet('isBookmarked', true);
});

test('user can unbookmark a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('bookmark')
        ->assertSet('isBookmarked', true)
        ->call('unbookmark')
        ->assertSet('isBookmarked', false);
});
