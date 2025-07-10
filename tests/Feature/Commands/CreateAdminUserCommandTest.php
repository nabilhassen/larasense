<?php

declare(strict_types=1);

use function Pest\Laravel\artisan;

test('command can create admin user', function () {
    artisan('make:admin')->assertSuccessful();

    $this->assertDatabaseCount('users', 1);
    $this->assertDatabaseHas('users', [
        'is_admin' => 1,
    ]);
});
