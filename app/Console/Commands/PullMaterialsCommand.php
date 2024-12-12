<?php

namespace App\Console\Commands;

use App\Jobs\PullMaterialsJob;
use App\Models\Source;
use Illuminate\Console\Command;

class PullMaterialsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larasense:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull content from rss sources';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (Source::tracked()->pluck('id') as $sourceId) {
            PullMaterialsJob::dispatch($sourceId);
        }
    }
}
