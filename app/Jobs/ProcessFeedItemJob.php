<?php

namespace App\Jobs;

use App\Actions\CreateMaterial;
use App\Data\MaterialData;
use App\Models\Source;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use SimplePie\Item;

class ProcessFeedItemJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $sourceId, public Item $item)
    {}

    /**
     * Execute the job.
     */
    public function handle(CreateMaterial $createMaterial): void
    {
        DB::transaction(function () use ($createMaterial) {
            $source = Source::find($this->sourceId, ['id', 'type', 'last_checked_at']);

            $createMaterial->handle(
                $source->id,
                MaterialData::create($source->type, $this->item),
            );

            $source->updateLastCheckedAt();
        });
    }
}
