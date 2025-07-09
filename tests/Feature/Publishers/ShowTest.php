<?php

declare(strict_types=1);

use App\Livewire\Publishers\Show;
use App\Models\Material;
use App\Models\Publisher;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    Material::factory(15)->create();

    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

test('publishers show component renders successfully', function () {
    Livewire::test(Show::class, ['slug' => Publisher::first()->slug])
        ->assertStatus(200);

    $this->get(route('publishers.show', Publisher::first()->slug))
        ->assertStatus(200);
});

test('publishers show component only renders materials of a specific publisher', function () {
    Livewire::test(Show::class, ['slug' => Publisher::first()->slug])
        ->assertViewHas('materials', function ($materials) {
            return $materials->toQuery()->whereRelation('source', 'publisher_id', '<>', Publisher::first()->id)->doesntExist();
        });
});
