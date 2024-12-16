<?php

namespace App\Actions;

use App\Data\MaterialData;
use App\Jobs\FetchMaterialImageJob;
use App\Models\Material;
use App\Models\Source;

class CreateMaterial
{
    public function handle(int $sourceId, MaterialData $materialData): Material
    {
        $source = Source::find($sourceId, ['id']);

        $material = $source
            ->materials()
            ->firstOrCreate([
                'url' => $materialData->url,
            ], [
                'title' => $materialData->title,
                'description' => $materialData->description,
                'body' => $materialData->body,
                'author' => $materialData->author,
                'published_at' => $materialData->publishedAt,
                'feed_id' => $materialData->feedId,
                'duration' => $materialData->duration,
                'is_displayed' => $materialData->isDisplayed,
            ]);

        FetchMaterialImageJob::dispatch($material->id, $materialData->imageUrl)->afterCommit();

        return $material;
    }
}
