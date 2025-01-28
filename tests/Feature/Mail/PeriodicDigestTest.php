<?php

use App\Enums\SourceType;
use App\Mail\PeriodicDigest;
use App\Models\Material;
use App\Models\User;
use function Pest\Laravel\artisan;
use Illuminate\Support\Facades\Mail;

test('mailable content are rendered properly', function () {
    $period = 'weekly';
    $subject = str('Larasense - ')->append($period, ' Digest')->headline();
    Material::factory(10)->create();

    $mailable = new PeriodicDigest($period);

    $youtubeMaterials = Material::feedQuery()->sourceType(SourceType::Youtube)->trending($period)->take(5)->get();
    $articleMaterials = Material::feedQuery()->sourceType(SourceType::Article)->trending($period)->take(5)->get();
    $podcastMaterials = Material::feedQuery()->sourceType(SourceType::Podcast)->trending($period)->take(5)->get();
    $categoryChampionMaterials = collect([$youtubeMaterials->first(), $articleMaterials->first(), $podcastMaterials->first()]);

    $mailable->assertSeeInOrderInHtml([
         ...$categoryChampionMaterials->pluck('title')->toArray(),
        ...$youtubeMaterials->pluck('title')->toArray(),
        ...$articleMaterials->pluck('title')->toArray(),
        ...$podcastMaterials->pluck('title')->toArray(),
    ]);

    $mailable->assertHasSubject($subject);
});

test('mail is queued', function () {
    User::factory(200)->create(['avatar_url' => null]);
    Mail::fake();

    artisan('larasense:digest --period=weekly');

    Mail::assertQueued(PeriodicDigest::class);
    Mail::assertQueuedCount(4);
});
