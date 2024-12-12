<?php

namespace App\Jobs;

use App\Actions\ProcessFeedItems;
use App\Models\Source;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use willvincent\Feeds\Facades\FeedsFacade;

class PullMaterialsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $sourceId)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::transaction(function () {
            $source = Source::find($this->sourceId);

            $feed = FeedsFacade::make($source->url, true);

            ProcessFeedItems::handle($source->id, $feed->get_items());

            $source->updateLastCheckedAt();
        });
    }
}
