<?php

declare(strict_types=1);

use App\Enums\SourceType;

test('homepage is rendered successfully', function () {
    $this
        ->get(route('home'))
        ->assertStatus(200);
});

test('terms page is rendered successfully', function () {
    $this
        ->get(route('terms'))
        ->assertStatus(200);
});

test('privacy policy page is rendered successfully', function () {
    $this
        ->get(route('privacy'))
        ->assertStatus(200);
});

test('feed page is rendered successfully', function () {
    $this
        ->get(route('materials.index'))
        ->assertStatus(200)
        ->assertSee(view('components.sidemenu'));
});

test('feed by source type page is rendered successfully', function () {
    $this
        ->get(route('feed.type', SourceType::Article))
        ->assertStatus(200)
        ->assertSee(view('components.sidemenu'));
});
