<?php

declare(strict_types=1);

use App\Livewire\Materials\Bookmarks;
use App\Livewire\Materials\Card;
use App\Models\Material;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

test('bookmarks page renders successfully', function () {
    $response = $this->get(route('bookmarks'));

    $response->assertStatus(200);
});

test('bookmarks feed displays bookmarked materials only', function () {
    Material::factory(10)->create();
    $material = Material::first();

    Livewire::test(Card::class, ['slug' => $material->slug])
        ->call('bookmark');

    Livewire::test(Bookmarks::class)
        ->assertStatus(200)
        ->assertViewHas('materials', function ($materials) use ($material) {
            return $materials->contains($material->id);
        });
});

test('bookmarks feed can load more bookmarked materials', function () {
    Material::factory(20)->create();

    foreach (Material::limit(15)->get() as $material) {
        Livewire::test(Card::class, ['slug' => $material->slug])
            ->call('bookmark');
    }

    Livewire::test(Bookmarks::class)
        ->assertStatus(200)
        ->assertViewHas('materials', function ($materials) {
            return count($materials->items()) === 12;
        })
        ->call('loadMore')
        ->assertViewHas('materials', function ($materials) {
            return count($materials->items()) === 15;
        });
});
