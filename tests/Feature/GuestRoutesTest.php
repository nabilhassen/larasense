<?php

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
