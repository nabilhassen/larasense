<?php

namespace App\Jobs;

use App\Actions\CheckSourceForNewContentAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CheckSourceForNewContentJob implements ShouldQueue
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
        CheckSourceForNewContentAction::handle($this->sourceId);
    }
}
