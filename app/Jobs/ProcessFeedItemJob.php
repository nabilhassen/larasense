<?php

namespace App\Jobs;

use App\Actions\CreateMaterial;
use App\Actions\TransformItems;
use App\Jobs\FetchMaterialImageJob;
use App\Models\Source;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
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
    public function handle(): void
    {
        $source = Source::find($this->sourceId);

        $data = TransformItems::handle($source->type, $this->item);

        $material = CreateMaterial::handle($source->id, $data);

        FetchMaterialImageJob::dispatch($material->id, $data['image_url']);

        $source->updateLastCheckedAt();
    }
}
