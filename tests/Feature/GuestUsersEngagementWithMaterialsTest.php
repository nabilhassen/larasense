<?php

declare(strict_types=1);

use App\Livewire\Materials\Card;
use App\Models\Material;
use Livewire\Livewire;

beforeEach(function () {
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

test('user cannot like a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('like')
        ->assertSet('isLiked', false);
});

test('user cannot unlike a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('like')
        ->assertSet('isLiked', false)
        ->call('unlike')
        ->assertSet('isLiked', false);
});

test('user has not liked a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->assertSet('likesCount', 0)
        ->call('like')
        ->call('like')
        ->assertSet('likesCount', 0);
});

test('user cannot dislike a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('dislike')
        ->assertSet('isDisliked', false);
});

test('user cannot undislike a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('dislike')
        ->assertSet('isDisliked', false)
        ->call('undislike')
        ->assertSet('isDisliked', false);
});

test('user cannot bookmark a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->assertSet('isBookmarked', false)
        ->call('bookmark')
        ->assertSet('isBookmarked', false);
});

test('user cannot unbookmark a material', function () {
    Livewire::test(Card::class, ['slug' => $this->material->slug])
        ->assertSet('slug', $this->material->slug)
        ->call('bookmark')
        ->assertSet('isBookmarked', false)
        ->call('unbookmark')
        ->assertSet('isBookmarked', false);
});
