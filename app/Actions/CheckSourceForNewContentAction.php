<?php

namespace App\Actions;

use App\Jobs\ProcessFeedItemJob;
use App\Models\Source;
use Illuminate\Support\Carbon;
use willvincent\Feeds\Facades\FeedsFacade;

class CheckSourceForNewContentAction
{
    public function handle(int $sourceId): void
    {
        $source = Source::find($sourceId);

        $items = FeedsFacade::make($source->url, true)->get_items();

        $latestMaterialBySourcePublishedAt = $source->latestMaterial?->published_at;

        foreach ($items as $item) {
            if (
                !is_null($latestMaterialBySourcePublishedAt) &&
                $latestMaterialBySourcePublishedAt->greaterThanOrEqualTo(Carbon::parse($item->get_date()))
            ) {
                return;
            }

            ProcessFeedItemJob::dispatch($source->id, $item);
        }
    }
}
