<?php

namespace App\Console\Commands;

use App\Jobs\CheckSourceForNewContentJob;
use App\Models\Source;
use Illuminate\Console\Command;

class LarasenseBotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larasense:bot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull content from sources';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (Source::tracked()->pluck('id') as $sourceId) {
            CheckSourceForNewContentJob::dispatch($sourceId);
        }
    }
}
