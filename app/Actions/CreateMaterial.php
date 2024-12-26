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

        if ($material = Material::where('url', $materialData->url)->first()) {
            return $material;
        }

        $material = $source
            ->materials()
            ->create([
                'title' => $materialData->title,
                'description' => $materialData->description,
                'body' => $materialData->body,
                'author' => $materialData->author,
                'published_at' => $materialData->publishedAt,
                'feed_id' => $materialData->feedId,
                'duration' => $materialData->duration,
                'is_displayed' => $materialData->isDisplayed,
                'url' => $materialData->url,
            ]);

        if (filled($materialData->imageUrl) && $material->isArticle()) {
            FetchMaterialImageJob::dispatch($material->id, $materialData->imageUrl)->afterCommit();
        }

        return $material;
    }
}
