<?php

declare(strict_types=1);

use App\Jobs\ProcessFeedItem;
use App\Jobs\SyncSourceFeed;
use App\Models\Material;
use App\Models\Source;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;
use SimplePie\Author;
use SimplePie\Enclosure;
use SimplePie\Item;
use SimplePie\SimplePie;
use willvincent\Feeds\Facades\FeedsFacade;

test('new feed item is queued for processing', function () {
    Queue::fake([ProcessFeedItem::class]);

    $source = Source::factory()->create();

    $item = mockFeedItem(now());

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

    $item = mockFeedItem(now()->subHours(5));

    $feed = $this->mock(SimplePie::class, function (MockInterface $mock) use ($item) {
        $mock->shouldReceive('error')->andReturnNull();
        $mock->shouldReceive('get_items')->andReturn([$item]);
    });

    FeedsFacade::shouldReceive('make')->with([$source->url], 20, true)->andReturn($feed);

    SyncSourceFeed::dispatch($source);

    expect(Context::has('material_url'))->toBeFalse();

    Queue::assertNotPushed(ProcessFeedItem::class);
});

test('if feed forcing does not work it falls back to without forcing', function () {
    Queue::fake([ProcessFeedItem::class]);

    $source = Source::factory()->create();

    $item = mockFeedItem(now());

    $feed = $this->mock(SimplePie::class, function (MockInterface $mock) use ($item) {
        $mock->shouldReceive('error')->andReturn(fake()->sentence());
        $mock->shouldReceive('get_items')->andReturn([$item]);
    });

    FeedsFacade::shouldReceive('make')->with([$source->url], 20, true)->andReturn($feed);

    FeedsFacade::shouldReceive('make')->with([$source->url], 20)->andReturn($feed);

    SyncSourceFeed::dispatch($source);

    Queue::assertPushed(ProcessFeedItem::class, 1);
});

function mockFeedItem(mixed $publishedAt): Item
{
    $author = Mockery::mock(Author::class, function (MockInterface $mock) {
        $mock->shouldReceive('get_name')->andReturn(fake()->name());
    });

    $enclosure = Mockery::mock(Enclosure::class, function (MockInterface $mock) {
        $mock->shouldReceive('get_description')->andReturn(fake()->paragraph());
        $mock->shouldReceive('get_duration')->andReturn(fake()->numberBetween(60, 3600));
        $mock->shouldReceive('get_link')->andReturn(fake()->url());
        $mock->shouldReceive('get_thumbnail')->andReturn(fake()->imageUrl());
    });

    return Mockery::mock(Item::class, function (MockInterface $mock) use ($author, $enclosure, $publishedAt) {
        $mock->shouldReceive('get_author')->andReturn($author);
        $mock->shouldReceive('get_content')->andReturn(fake()->paragraph());
        $mock->shouldReceive('get_date')->andReturn($publishedAt);
        $mock->shouldReceive('get_description')->andReturn(fake()->paragraph());
        $mock->shouldReceive('get_enclosure')->andReturn($enclosure);
        $mock->shouldReceive('get_id')->with(true)->andReturn(fake()->uuid());
        $mock->shouldReceive('get_item_tags')->with(SimplePie::NAMESPACE_ITUNES, 'author')->andReturn([]);
        $mock->shouldReceive('get_item_tags')->with(SimplePie::NAMESPACE_ITUNES, 'duration')->andReturn([]);
        $mock->shouldReceive('get_item_tags')->with(SimplePie::NAMESPACE_ITUNES, 'image')->andReturn([]);
        $mock->shouldReceive('get_link')->andReturn(fake()->url());
        $mock->shouldReceive('get_title')->andReturn(fake()->sentence());
    });
}
