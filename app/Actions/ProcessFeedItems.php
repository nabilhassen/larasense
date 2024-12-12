<?php

namespace App\Actions;

use App\Actions\CreateMaterial;
use App\Actions\TransformItems;
use App\Jobs\FetchMaterialImageJob;
use App\Models\Source;
use Illuminate\Support\Carbon;

class ProcessFeedItems
{
    public static function handle(int $sourceId, array $items): void
    {
        $source = Source::find($sourceId);

        $latestMaterialBySourcePublishedAt = $source->materials()->latest('published_at')->first()?->published_at;

        foreach ($items as $item) {
            if (
                !is_null($latestMaterialBySourcePublishedAt) &&
                $latestMaterialBySourcePublishedAt->greaterThanOrEqualTo(Carbon::parse($item->get_date()))
            ) {
                return;
            }

            $data = TransformItems::handle($source->type, $item);

            $material = CreateMaterial::handle($source->id, $data);

            FetchMaterialImageJob::dispatch($material->id, $data['image_url']);
        }
    }
}
