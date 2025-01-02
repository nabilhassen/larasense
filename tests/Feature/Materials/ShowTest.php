<?php

use App\Livewire\Materials\Show;
use App\Models\Material;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);

    Material::factory()->create();

    $this->material = Material::feedQuery()->first();
});

test('material item is render successfully', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material);
});

test('material item views count can increment', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->call('viewed')
        ->call('viewed');

    expect($this->material->fresh()->views)->toBe(2);
});

test('material item expands count can increment', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->call('expanded')
        ->call('expanded');

    expect($this->material->fresh()->expands)->toBe(2);
});

test('material item redirects count can increment', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->call('redirected')
        ->call('redirected');

    expect($this->material->fresh()->redirects)->toBe(2);
});

test('material item plays count can increment', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->call('played')
        ->call('played');

    expect($this->material->fresh()->plays)->toBe(2);
});

test('material item expands can increment', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->call('expanded')
        ->call('expanded');

    expect($this->material->fresh()->expands)->toBe(2);
});

test('user can like a material', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->call('like');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('isLiked', true);
});

test('user can unlike a material', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->call('like');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('isLiked', true)
        ->call('unlike');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('isLiked', false);
});

test('user has liked one material', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->assertSet('likesCount', 0)
        ->call('like')
        ->call('like');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('likesCount', 1);
});

test('user can dislike a material', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->call('dislike');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('isDisliked', true);
});

test('user can undislike a material', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->call('dislike');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('isDisliked', true)
        ->call('undislike');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('isDisliked', false);
});

test('user can like then dislike a material', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->call('like');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('isLiked', true)
        ->assertSet('isDisliked', false)
        ->call('dislike');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('isLiked', false)
        ->assertSet('isDisliked', true);
});

test('user can dislike then like a material', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->call('dislike');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('isDisliked', true)
        ->assertSet('isLiked', false)
        ->call('like');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('isDisliked', false)
        ->assertSet('isLiked', true);
});

test('user can bookmark a material', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->assertSet('isBookmarked', false)
        ->call('bookmark');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('isBookmarked', true);
});

test('user can unbookmark a material', function () {
    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('material', $this->material)
        ->call('bookmark');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('isBookmarked', true)
        ->call('unbookmark');

    $this->material = Material::feedQuery()->find($this->material->id);

    Livewire::test(Show::class, ['material' => $this->material])
        ->assertSet('isBookmarked', false);
});
