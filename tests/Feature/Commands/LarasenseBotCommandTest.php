<?php

use App\Jobs\CheckSourceForNewContentJob;
use App\Jobs\ProcessFeedItemJob;
use App\Models\Source;
use function Pest\Laravel\artisan;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;
use shweshi\OpenGraph\Facades\OpenGraphFacade;
use SimplePie\Item;
use SimplePie\SimplePie;
use willvincent\Feeds\Facades\FeedsFacade;

test('sources are queued for update checking', function () {
    Queue::fake();

    Source::factory(5)->create();

    artisan('larasense:bot');

    Queue::assertPushed(CheckSourceForNewContentJob::class, 5);
});

test('untracked sources are not queued for update checking', function () {
    Queue::fake();

    Source::factory(4)->create();
    Source::factory()->create(['is_tracked' => 0]);

    artisan('larasense:bot');

    Queue::assertPushed(CheckSourceForNewContentJob::class, 4);
});

test('feed item is queued for processing', function () {
    Queue::fake([ProcessFeedItemJob::class]);

    $source = Source::factory()->create();

    $item = mockFeedItem();

    $feedItems = $this->mock(SimplePie::class, function (MockInterface $mock) use ($item) {
        $mock->shouldReceive('get_items')->andReturn([$item]);
    });

    FeedsFacade::shouldReceive('make')->with([$source->url], 20, true)->andReturn($feedItems);

    artisan('larasense:bot');

    expect(Context::has('material_url'))->toEqual($item->get_link());

    Queue::assertPushed(ProcessFeedItemJob::class, 1);
});

test('feed item is processed and stored in the database as a material', function () {
    $source = Source::factory()->create();

    $item = mockFeedItem();

    $feedItems = $this->mock(SimplePie::class, function (MockInterface $mock) use ($item) {
        $mock->shouldReceive('get_items')->andReturn([$item]);
    });

    FeedsFacade::shouldReceive('make')->with([$source->url], 20, true)->andReturn($feedItems);

    OpenGraphFacade::shouldReceive('fetch')->with($item->get_link(), true)->andReturn([
        'description' => fake()->text(),
        'image:secure_url' => fake()->imageUrl(),
    ]);

    artisan('larasense:bot');

    // expect(Context::has('material_url'))->toEqual($item->get_link());

    $this->assertDatabaseCount('materials', 1);
})->todo('serializing mocked objects issue');

function mockFeedItem(): MockInterface
{
    return Mockery::mock(Item::class, function (MockInterface $mock) {
        $mock->shouldReceive('get_title')->andReturn(fake()->text());
        $mock->shouldReceive('get_description')->andReturn(fake()->text());
        $mock->shouldReceive('get_content')->andReturn(fake()->text());
        $mock->shouldReceive('get_author')->andReturn(fake()->text());
        $mock->shouldReceive('get_link')->andReturn(fake()->url());
        $mock->shouldReceive('get_date')->andReturn(now());
        $mock->shouldReceive('get_id')->andReturn(fake()->text());
        $mock->shouldReceive('get_enclosure->get_thumbnail')->andReturn(fake()->imageUrl());
        $mock->shouldReceive('get_enclosure->get_duration')->andReturn(fake()->randomDigitNotNull());
    });
}
