<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\MaterialData;
use App\Jobs\FetchAndUpdateMaterialImage;
use App\Models\Material;
use App\Models\Source;
use Illuminate\Support\Facades\DB;

class CreateMaterial
{
    public function handle(Source $source, MaterialData $materialData): Material
    {
        if ($material = Material::where('url', $materialData->url)->first()) {
            return $material;
        }

        return DB::transaction(function () use ($source, $materialData): Material {
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
                    'image_url' => $materialData->imageUrl,
                ]);

            if (filled($material->image_url) && $material->isArticle()) {
                FetchAndUpdateMaterialImage::dispatch($material)->afterCommit();
            }

            return $material;
        });
    }
}
