<?php

use App\Enums\SourceType;
use App\Livewire\FeedBySourceType;
use App\Models\Material;
use App\Models\Source;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    Material::factory(15)->create();

    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

test('feed by source type component renders successfully', function () {
    Livewire::test(FeedBySourceType::class, ['type' => SourceType::Article])
        ->assertStatus(200);

    Livewire::test(FeedBySourceType::class, ['type' => SourceType::Podcast])
        ->assertStatus(200);

    Livewire::test(FeedBySourceType::class, ['type' => SourceType::Youtube])
        ->assertStatus(200);
});

test('feed by source type component only renders materials of a specific source type', function () {
    Material::factory(10)
        ->for(
            Source::factory()->state(['type' => SourceType::Article])
        )
        ->create();

    Livewire::test(FeedBySourceType::class, ['type' => SourceType::Article])
        ->assertViewHas('materials', function ($materials) {
            return $materials->toQuery()->whereRelation('source', 'type', '<>', SourceType::Article)->doesntExist();
        });
});
