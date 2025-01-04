<?php

use App\Livewire\Search;
use App\Models\Material;
use App\Models\Publisher;
use App\Models\User;
use Livewire\Livewire;
use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Like;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

test('search returns empty collection if null or spaces are provided', function () {
    Material::factory(10)->create();

    Livewire::test(Search::class)
        ->set('query', '   ')
        ->assertViewHas('materials', function ($materials) {
            return $materials->isEmpty();
        })
        ->set('query', null)
        ->assertViewHas('materials', function ($materials) {
            return $materials->isEmpty();
        });
});

test('search returns relevant materials', function () {
    Material::factory(10)->create();

    Livewire::test(Search::class)
        ->set('query', Publisher::first()->name)
        ->assertViewHas('materials', function ($materials) {
            return $materials->isNotEmpty();
        });
});

test('a material can be viewed', function () {
    Material::factory(10)->create();
    $selectedMaterial = Material::firstOrFail();

    Livewire::test(Search::class)
        ->set('slug', $selectedMaterial->slug)
        ->call('view')
        ->assertViewHas('material', function ($material) use ($selectedMaterial) {
            return $material->id === $selectedMaterial->id;
        })
        ->assertSeeHtml($selectedMaterial->title);
});

test('a material expanded metric increments', function () {
    Material::factory(10)->create();
    $selectedMaterial = Material::firstOrFail();

    Livewire::test(Search::class)
        ->set('slug', $selectedMaterial->slug)
        ->call('view')
        ->call('expanded');

    expect($selectedMaterial->expands)->toBe(0);
    expect($selectedMaterial->refresh()->expands)->toBe(1);
});

test('a material can be engaged with', function () {
    Material::factory(10)->create();
    $selectedMaterial = Material::firstOrFail();

    Livewire::test(Search::class)
        ->set('slug', $selectedMaterial->slug)
        ->call('view')
        ->call('like')
        ->call('bookmark');

    expect(Like::has($selectedMaterial, $this->user))->toBeTrue();
    expect(Bookmark::has($selectedMaterial, $this->user))->toBeTrue();
});
