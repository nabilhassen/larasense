<?php

use function Pest\Laravel\artisan;

test('command can create admin user', function () {
    artisan('make:admin')->assertSuccessful();

    $this->assertDatabaseCount('users', 1);
    $this->assertDatabaseHas('users', [
        'email' => 'admin@larasense.com',
    ]);
});

test('command can create admin user only once', function () {
    artisan('make:admin')->assertSuccessful();

    $this->assertDatabaseCount('users', 1);
    $this->assertDatabaseHas('users', [
        'email' => 'admin@larasense.com',
    ]);

    artisan('make:admin')->assertSuccessful();

    $this->assertDatabaseCount('users', 1);
    $this->assertDatabaseHas('users', [
        'email' => 'admin@larasense.com',
    ]);
});
