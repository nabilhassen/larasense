<?php

declare(strict_types=1);

use App\Livewire\Materials\Show;
use App\Models\Material;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);

    Material::factory()->create();

    $this->material = Material::firstOrFail();
});

test('material show route renders successfully', function () {
    $this->get(route('materials.show', $this->material->slug))
        ->assertStatus(200);
});

test('material show component renders successfully', function () {
    Livewire::test(Show::class, ['slug' => $this->material->slug])
        ->assertViewHas('material', Material::feedQuery()->slug($this->material->slug)->firstOrFail());
});
