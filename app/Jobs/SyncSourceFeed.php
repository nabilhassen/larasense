<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Source;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Carbon;
use willvincent\Feeds\Facades\FeedsFacade;

class SyncSourceFeed implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Source $source) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $feed = FeedsFacade::make([$this->source->url], 20, true);

        if (filled($feed->error())) {
            $feed = FeedsFacade::make([$this->source->url], 20);
        }

        $latestMaterial = $this->source->latestMaterial;

        foreach ($feed->get_items() as $item) {
            $itemPublishedAt = Carbon::parse($item->get_date())->timezone(config('app.timezone'));

            if (filled($latestMaterial) && $latestMaterial->published_at->greaterThanOrEqualTo($itemPublishedAt)) {
                break;
            }

            ProcessFeedItem::dispatch($this->source, $item);
        }

        $this->source->updateLastCheckedAt();
    }
}
