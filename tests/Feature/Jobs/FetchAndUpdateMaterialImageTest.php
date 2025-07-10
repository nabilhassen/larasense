<?php

declare(strict_types=1);

use App\Enums\SourceType;
use App\Jobs\FetchAndUpdateMaterialImage;
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

    FetchAndUpdateMaterialImage::dispatch($material);

    Storage::disk('public')->assertExists($material->fresh()->image_url);
});
