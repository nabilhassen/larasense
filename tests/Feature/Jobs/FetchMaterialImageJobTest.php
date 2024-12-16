<?php

use App\Jobs\FetchMaterialImageJob;
use App\Models\Material;
use Illuminate\Support\Facades\Storage;

test('material images are fetched and stored in disk', function () {
    Storage::fake('public');

    $material = Material::factory()->create();

    FetchMaterialImageJob::dispatch($material->id, 'https://picsum.photos/600/480');

    Storage::disk('public')->assertExists($material->fresh()->image_url);
});

test('material has no image to be fetched', function () {
    $material = Material::factory()->create(['image_url' => null]);

    FetchMaterialImageJob::dispatch($material->id);

    expect($material->fresh()->image_url)->toBeNull();
});
