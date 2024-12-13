<?php

namespace App\Actions;

use App\Jobs\ProcessFeedItemJob;
use App\Models\Source;
use Illuminate\Support\Carbon;
use willvincent\Feeds\Facades\FeedsFacade;

class CheckSourceForNewContentAction
{
    public static function handle(int $sourceId): void
    {
        $source = Source::find($sourceId);

        $items = FeedsFacade::make($source->url, true)->get_items();

        $latestMaterialBySourcePublishedAt = $source->materials()->latest('published_at')->first()?->published_at;

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
