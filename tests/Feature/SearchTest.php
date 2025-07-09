<?php

declare(strict_types=1);

use App\Livewire\Search;
use App\Models\Material;
use App\Models\Publisher;
use App\Models\User;
use Livewire\Livewire;

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
