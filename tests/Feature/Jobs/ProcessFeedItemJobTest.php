<?php

use App\Enums\SourceType;
use App\Jobs\FetchMaterialImageJob;
use App\Jobs\ProcessFeedItemJob;
use App\Models\Source;
use Illuminate\Support\Facades\Queue;
use willvincent\Feeds\Facades\FeedsFacade;

test('article feed item is processed and stored in the database as a material', function () {
    Queue::fake(FetchMaterialImageJob::class);

    $source = Source::factory()->create([
        'url' => 'https://www.reddit.com/r/laravel.rss',
        'type' => SourceType::Article,
        'last_checked_at' => now()->subDay(),
    ]);

    $item = FeedsFacade::make([$source->url], 1, true)->get_item();

    ProcessFeedItemJob::dispatch($source->id, $item);

    Queue::assertPushed(FetchMaterialImageJob::class);
    $this->assertDatabaseCount('materials', 1);
    $this->assertDatabaseHas('materials', [
        'feed_id' => $item->get_id(true),
    ]);
    expect($source->last_checked_at->lessThan($source->refresh()->last_checked_at))->toBeTrue();

});

test('youtube feed item is processed and stored in the database as a material', function () {
    Queue::fake(FetchMaterialImageJob::class);

    $source = Source::factory()->create([
        'url' => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCTuplgOBi6tJIlesIboymGA',
        'type' => SourceType::Youtube,
        'last_checked_at' => now()->subDay(),
    ]);

    $item = FeedsFacade::make([$source->url], 1, true)->get_item();

    ProcessFeedItemJob::dispatch($source->id, $item);

    Queue::assertPushed(FetchMaterialImageJob::class);
    $this->assertDatabaseCount('materials', 1);
    $this->assertDatabaseHas('materials', [
        'feed_id' => $item->get_id(true),
    ]);
    expect($source->last_checked_at->lessThan($source->refresh()->last_checked_at))->toBeTrue();

});

test('podcast feed item is processed and stored in the database as a material', function () {
    Queue::fake(FetchMaterialImageJob::class);

    $source = Source::factory()->create([
        'url' => 'https://feeds.transistor.fm/the-laravel-podcast',
        'type' => SourceType::Podcast,
        'last_checked_at' => now()->subDay(),
    ]);

    $item = FeedsFacade::make([$source->url], 1, true)->get_item();

    ProcessFeedItemJob::dispatch($source->id, $item);

    Queue::assertPushed(FetchMaterialImageJob::class);
    $this->assertDatabaseCount('materials', 1);
    $this->assertDatabaseHas('materials', [
        'feed_id' => $item->get_id(true),
    ]);
    expect($source->last_checked_at->lessThan($source->refresh()->last_checked_at))->toBeTrue();

});
