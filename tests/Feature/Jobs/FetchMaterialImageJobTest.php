<?php

use App\Enums\SourceType;
use App\Jobs\FetchMaterialImageJob;
use App\Models\Material;
use App\Models\Source;
use Illuminate\Support\Facades\Storage;

test('article material images are fetched and stored in disk', function () {
    Storage::fake('public');

    $material = Material::factory()
        ->for(
            Source::factory()
                ->state(['type' => SourceType::Article])
        )
        ->create();

    FetchMaterialImageJob::dispatch($material->id, 'https://picsum.photos/600/480');

    Storage::disk('public')->assertExists($material->fresh()->image_url);
});
