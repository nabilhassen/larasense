<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Uri;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemapCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        SitemapGenerator::create(config('app.url'))
            ->shouldCrawl(function (string $url): bool {
                return str(Uri::of($url)->path())
                    ->doesntContain([
                        '/auth',
                        'password',
                    ]);
            })
            ->writeToFile(public_path('sitemap.xml'));
    }
}
