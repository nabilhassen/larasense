<?php

use App\Models\User;

test('user is persisted in deleted_users table on deleted user model event', function () {
    $user = User::factory()->create();

    $user->delete();

    $this->assertDatabaseHas('deleted_users', $user->only(['name', 'email']));

    $this->assertDatabaseMissing('users', $user->only(['name', 'email']));
});
