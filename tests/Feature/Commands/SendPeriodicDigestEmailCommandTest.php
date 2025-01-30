<?php

use App\Enums\DigestFrequency;
use App\Mail\PeriodicDigest;
use App\Models\User;
use function Pest\Laravel\artisan;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    User::factory(200)->create(['avatar_url' => null]);
});

test('command runs successfully', function () {
    Mail::fake();

    artisan('larasense:digest --period=weekly');

    Mail::assertQueued(PeriodicDigest::class);
    Mail::assertQueuedCount(200);
});

test('users are excluded if digest_frequency is set to never', function () {
    User::query()->limit(50)->update(['digest_frequency' => DigestFrequency::Never]);
    Mail::fake();

    artisan('larasense:digest --period=weekly');

    Mail::assertQueued(PeriodicDigest::class);
    Mail::assertQueuedCount(150);
});

test('users are excluded if email is not verified', function () {
    User::query()->limit(50)->update(['email_verified_at' => null]);
    Mail::fake();

    artisan('larasense:digest --period=weekly');

    Mail::assertQueued(PeriodicDigest::class);
    Mail::assertQueuedCount(150);
});

test('mail is queued for users with monthly frequency only', function () {
    User::query()->update(['digest_frequency' => DigestFrequency::Never]);
    User::query()->limit(100)->update(['digest_frequency' => DigestFrequency::Monthly]);
    Mail::fake();

    artisan('larasense:digest --period=monthly');

    Mail::assertQueued(PeriodicDigest::class);
    Mail::assertQueuedCount(100);
});

test('nothing will be queued if period option is invalid', function () {
    Mail::fake();

    artisan('larasense:digest --period=' . fake()->word());

    Mail::assertNothingQueued();
});
