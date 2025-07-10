<?php

declare(strict_types=1);

use App\Enums\SourceType;
use App\Jobs\FetchAndUpdateMaterialImage;
use App\Jobs\ProcessFeedItem;
use App\Models\Material;
use App\Models\Source;
use Illuminate\Support\Facades\Queue;
use willvincent\Feeds\Facades\FeedsFacade;

test('article feed item is processed and stored in the database as a material', function () {
    Queue::fake(FetchAndUpdateMaterialImage::class);

    $source = Source::factory()->create([
        'url' => 'https://www.aljazeera.com/xml/rss/all.xml',
        'type' => SourceType::Article,
        'last_checked_at' => now()->subDay(),
    ]);

    $item = FeedsFacade::make([$source->url], 1)->get_item();

    ProcessFeedItem::dispatch($source, $item);

    Queue::assertPushed(FetchAndUpdateMaterialImage::class);
    $this->assertDatabaseCount('materials', 1);
    $this->assertDatabaseHas('materials', [
        'feed_id' => $item->get_id(true),
    ]);
});

test('youtube feed item is processed and stored in the database as a material', function () {
    Queue::fake(FetchAndUpdateMaterialImage::class);

    $source = Source::factory()->create([
        'url' => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCTuplgOBi6tJIlesIboymGA',
        'type' => SourceType::Youtube,
        'last_checked_at' => now()->subDay(),
    ]);

    $item = FeedsFacade::make([$source->url], 1)->get_item();

    ProcessFeedItem::dispatch($source, $item);

    Queue::assertNotPushed(FetchAndUpdateMaterialImage::class);
    $this->assertDatabaseCount('materials', 1);
    $this->assertDatabaseHas('materials', [
        'feed_id' => $item->get_id(true),
    ]);
});

test('podcast feed item is processed and stored in the database as a material', function () {
    Queue::fake(FetchAndUpdateMaterialImage::class);

    $source = Source::factory()->create([
        'url' => 'https://feeds.transistor.fm/the-laravel-podcast',
        'type' => SourceType::Podcast,
        'last_checked_at' => now()->subDay(),
    ]);

    $item = FeedsFacade::make([$source->url], 1)->get_item();

    ProcessFeedItem::dispatch($source, $item);

    Queue::assertNotPushed(FetchAndUpdateMaterialImage::class);
    $this->assertDatabaseCount('materials', 1);
    $this->assertDatabaseHas('materials', [
        'feed_id' => $item->get_id(true),
    ]);
});

test('duplicate article feed item will not be stored', function () {
    $material = Material::factory()->create(['published_at' => now()->subYears(10)]);
    Queue::fake(FetchAndUpdateMaterialImage::class);

    $this->assertDatabaseCount('materials', 1);

    $source = Source::factory()->create([
        'url' => 'https://archive.nytimes.com/www.nytimes.com/services/xml/rss/index.html?mcubz=0',
        'type' => SourceType::Article,
        'last_checked_at' => now()->subDay(),
    ]);

    $item = FeedsFacade::make([$source->url], 1)->get_item();
    $material->url = $item->get_link();
    $material->feed_id = $item->get_id(true);
    $material->save();

    ProcessFeedItem::dispatch($source, $item);

    Queue::assertNotPushed(FetchAndUpdateMaterialImage::class);
    $this->assertDatabaseCount('materials', 1);
    $this->assertDatabaseHas('materials', [
        'url' => $item->get_link(),
        'feed_id' => $item->get_id(true),
    ]);
});
