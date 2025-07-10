<?php

declare(strict_types=1);

use App\Livewire\Materials\Card;
use App\Livewire\Materials\Likes;
use App\Models\Material;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

test('likes page renders successfully', function () {
    $response = $this->get(route('likes'));

    $response->assertStatus(200);
});

test('likes feed displays liked materials only', function () {
    Material::factory(10)->create();
    $material = Material::firstOrFail();

    Livewire::test(Card::class, ['slug' => $material->slug])
        ->call('like');

    Livewire::test(Likes::class)
        ->assertStatus(200)
        ->assertViewHas('materials', function ($materials) use ($material) {
            return $materials->contains($material->id);
        });
});

test('likes feed can load more liked materials', function () {
    Material::factory(20)->create();

    foreach (Material::limit(15)->get() as $material) {
        Livewire::test(Card::class, ['slug' => $material->slug])
            ->call('like');
    }

    Livewire::test(Likes::class)
        ->assertStatus(200)
        ->assertViewHas('materials', function ($materials) {
            return count($materials->items()) === 12;
        })
        ->call('loadMore')
        ->assertViewHas('materials', function ($materials) {
            return count($materials->items()) === 15;
        });
});
