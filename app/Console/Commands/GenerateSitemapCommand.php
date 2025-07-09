<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Psr\Http\Message\UriInterface;
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
            ->shouldCrawl(function (UriInterface $url) {
                // All pages will be crawled, except the contact page.
                // Links present on the contact page won't be added to the
                // sitemap unless they are present on a crawlable page.

                return ! str($url->getPath())
                    ->contains([
                        '/auth',
                        'password',
                    ]);
            })
            ->writeToFile(public_path('sitemap.xml'));
    }
}
