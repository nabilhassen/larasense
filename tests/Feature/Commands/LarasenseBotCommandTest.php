<?php

use App\Jobs\CheckSourceForNewContentJob;
use App\Models\Source;
use function Pest\Laravel\artisan;
use Illuminate\Support\Facades\Queue;

test('sources are queued for new content checking', function () {
    Queue::fake();

    Source::factory(5)->create();

    artisan('larasense:bot');

    Queue::assertPushed(CheckSourceForNewContentJob::class, 5);
});

test('untracked sources are not queued for new content checking', function () {
    Queue::fake();

    Source::factory(4)->create();
    Source::factory()->create(['is_tracked' => 0]);

    artisan('larasense:bot');

    Queue::assertPushed(CheckSourceForNewContentJob::class, 4);
});

test('untracked publishers sources are not queued for new content checking', function () {
    Queue::fake();

    Source::factory(5)->create();
    Source::first()->publisher->untrack();

    artisan('larasense:bot');

    Queue::assertPushed(CheckSourceForNewContentJob::class, 4);
});
