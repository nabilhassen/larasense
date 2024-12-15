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
                'feed_id' => $materialData->id,
            ], [
                'title' => $materialData->title,
                'description' => $materialData->description,
                'body' => $materialData->body,
                'author' => $materialData->author,
                'url' => $materialData->url,
                'published_at' => $materialData->publishedAt,
                'duration' => $materialData->duration,
                'is_displayed' => 1,
            ]);

        FetchMaterialImageJob::dispatch($material->id, $materialData->imageUrl)->afterCommit();

        return $material;
    }
}
