<?php

use App\Livewire\Search;
use App\Models\Material;
use App\Models\Publisher;
use Livewire\Livewire;

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
    $selectedMaterial = Material::feedQuery()->addSelect('duration')->firstOrFail();

    Livewire::test(Search::class)
        ->call('view', $selectedMaterial->slug)
        ->assertSet('material', function ($material) use ($selectedMaterial) {
            return $material->id === $selectedMaterial->id;
        })
        ->assertSeeHtml($selectedMaterial->title);
});
