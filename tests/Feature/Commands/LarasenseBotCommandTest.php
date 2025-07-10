<?php

declare(strict_types=1);

use App\Jobs\SyncSourceFeed;
use App\Models\Source;
use Illuminate\Support\Facades\Queue;

use function Pest\Laravel\artisan;

test('sources are queued for new content checking', function () {
    Queue::fake();

    Source::factory(5)->create();

    artisan('larasense:bot');

    Queue::assertPushed(SyncSourceFeed::class, 5);
});

test('untracked sources are not queued for new content checking', function () {
    Queue::fake();

    Source::factory(4)->create();
    Source::factory()->create(['is_tracked' => 0]);

    artisan('larasense:bot');

    Queue::assertPushed(SyncSourceFeed::class, 4);
});

test('untracked publishers sources are not queued for new content checking', function () {
    Queue::fake();

    Source::factory(5)->create();
    Source::first()->publisher->untrack();

    artisan('larasense:bot');

    Queue::assertPushed(SyncSourceFeed::class, 4);
});
