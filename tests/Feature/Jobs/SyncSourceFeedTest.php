<?php

declare(strict_types=1);

use App\Jobs\ProcessFeedItem;
use App\Jobs\SyncSourceFeed;
use App\Models\Material;
use App\Models\Source;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;
use SimplePie\Item;
use SimplePie\SimplePie;
use willvincent\Feeds\Facades\FeedsFacade;

test('new feed item is queued for processing', function () {
    Queue::fake([ProcessFeedItem::class]);

    $source = Source::factory()->create();

    $item = $this->mock(Item::class, function (MockInterface $mock) {
        $mock->shouldReceive('get_link')->andReturn(fake()->url());
        $mock->shouldReceive('get_date')->andReturn(now());
    });

    $feed = $this->mock(SimplePie::class, function (MockInterface $mock) use ($item) {
        $mock->shouldReceive('error')->andReturnNull();
        $mock->shouldReceive('get_items')->andReturn([$item]);
    });

    FeedsFacade::shouldReceive('make')->with([$source->url], 20, true)->andReturn($feed);

    SyncSourceFeed::dispatch($source);

    Queue::assertPushed(ProcessFeedItem::class, 1);
});

test('old feed item is not queued for processing', function () {
    Queue::fake([ProcessFeedItem::class]);

    $source = Source::factory()->create();
    Material::factory()->for($source)->create();

    $item = $this->mock(Item::class, function (MockInterface $mock) {
        $mock->shouldReceive('get_link')->andReturn(fake()->url());
        $mock->shouldReceive('get_date')->andReturn(now()->subHours(5));
    });

    $feed = $this->mock(SimplePie::class, function (MockInterface $mock) use ($item) {
        $mock->shouldReceive('error')->andReturnNull();
        $mock->shouldReceive('get_items')->andReturn([$item]);
    });

    FeedsFacade::shouldReceive('make')->with([$source->url], 20, true)->andReturn($feed);

    SyncSourceFeed::dispatch($source);

    expect(Context::has('material_url'))->toBeFalse();

    Queue::assertPushed(ProcessFeedItem::class, 0);
});

test('if feed forcing does not work it falls back to without forcing', function () {
    Queue::fake([ProcessFeedItem::class]);

    $source = Source::factory()->create();

    $item = $this->mock(Item::class, function (MockInterface $mock) {
        $mock->shouldReceive('get_link')->andReturn(fake()->url());
        $mock->shouldReceive('get_date')->andReturn(now());
    });

    $feed = $this->mock(SimplePie::class, function (MockInterface $mock) use ($item) {
        $mock->shouldReceive('error')->andReturn(fake()->sentence());
        $mock->shouldReceive('get_items')->andReturn([$item]);
    });

    FeedsFacade::shouldReceive('make')->with([$source->url], 20, true)->andReturn($feed);

    FeedsFacade::shouldReceive('make')->with([$source->url], 20)->andReturn($feed);

    SyncSourceFeed::dispatch($source);

    Queue::assertPushed(ProcessFeedItem::class, 1);
});
