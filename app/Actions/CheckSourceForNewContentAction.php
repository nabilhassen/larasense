<?php

namespace App\Actions;

use App\Jobs\ProcessFeedItemJob;
use App\Models\Source;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Context;
use willvincent\Feeds\Facades\FeedsFacade;

class CheckSourceForNewContentAction
{
    public function handle(int $sourceId): void
    {
        $source = Source::find($sourceId, ['id', 'url']);

        $items = FeedsFacade::make([$source->url], 20, true)->get_items();

        $latestMaterialBySourcePublishedAt = $source->latestMaterial?->published_at;

        foreach ($items as $item) {
            if (
                !is_null($latestMaterialBySourcePublishedAt) &&
                $latestMaterialBySourcePublishedAt->greaterThanOrEqualTo(Carbon::parse($item->get_date()))
            ) {
                $source->updateLastCheckedAt();
                return;
            }

            Context::add('material_url', $item->get_link() ?? $item->get_enclosure()->get_link());

            ProcessFeedItemJob::dispatch($source->id, $item);
        }
    }
}
