<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Actions\CreateMaterial;
use App\Data\MaterialData;
use App\Models\Source;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessFeedItem implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Source $source,
        public MaterialData $materialData
    ) {}

    /**
     * Execute the job.
     */
    public function handle(CreateMaterial $createMaterial): void
    {
        $createMaterial->handle(
            $this->source,
            $this->materialData
        );
    }
}
