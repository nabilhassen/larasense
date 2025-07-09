<?php

declare(strict_types=1);

use App\Livewire\Materials\Index;
use App\Models\Material;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

test('feed renders successfully', function () {
    $response = $this->get(route('materials.index'));

    $response->assertStatus(200);
});

test('feed displays materials', function () {
    Material::factory(15)->create();

    Livewire::test(Index::class)
        ->assertStatus(200)
        ->assertViewHas('materials', function ($materials) {
            return count($materials->items()) === 12;
        });
});

test('feed can load more materials', function () {
    Material::factory(15)->create();

    Livewire::test(Index::class)
        ->assertStatus(200)
        ->assertViewHas('materials', function ($materials) {
            return count($materials->items()) === 12;
        })
        ->call('loadMore')
        ->assertViewHas('materials', function ($materials) {
            return count($materials->items()) === 15;
        });
});
