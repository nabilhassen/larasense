<?php

namespace App\Jobs;

use App\Actions\CheckSourceForNewContentAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class CheckSourceForNewContentJob implements ShouldQueue
{
    use Queueable, IsMonitored;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $sourceId)
    {}

    /**
     * Execute the job.
     */
    public function handle(CheckSourceForNewContentAction $checkSourceForNewContentAction): void
    {
        $checkSourceForNewContentAction->handle($this->sourceId);
    }
}
