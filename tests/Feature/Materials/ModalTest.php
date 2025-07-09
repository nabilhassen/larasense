<?php

declare(strict_types=1);

use App\Livewire\Materials\Modal;
use App\Models\Material;
use App\Models\User;
use Livewire\Livewire;
use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Like;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

test('a material can be viewed', function () {
    Material::factory(10)->create();
    $selectedMaterial = Material::firstOrFail();

    Livewire::test(Modal::class)
        ->dispatch('open-material-modal', $selectedMaterial->slug)
        ->assertViewHas('material', function ($material) use ($selectedMaterial) {
            return $material->id === $selectedMaterial->id;
        })
        ->assertSeeHtml($selectedMaterial->title);
});

test('a material expanded metric increments', function () {
    Material::factory(10)->create();
    $selectedMaterial = Material::firstOrFail();

    Livewire::test(Modal::class)
        ->dispatch('open-material-modal', $selectedMaterial->slug)
        ->call('expanded');

    expect($selectedMaterial->expands)->toBe(0);
    expect($selectedMaterial->refresh()->expands)->toBe(1);
});

test('a material can be engaged with', function () {
    Material::factory(10)->create();
    $selectedMaterial = Material::firstOrFail();

    Livewire::test(Modal::class)
        ->dispatch('open-material-modal', $selectedMaterial->slug)
        ->call('like')
        ->call('bookmark');

    expect(Like::has($selectedMaterial, $this->user))->toBeTrue();
    expect(Bookmark::has($selectedMaterial, $this->user))->toBeTrue();
});
