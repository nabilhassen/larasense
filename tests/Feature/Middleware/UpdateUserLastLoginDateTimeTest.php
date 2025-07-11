<?php

declare(strict_types=1);

use App\Models\User;

test('user last login time is being updated', function () {
    $this->user = User::factory()->create();

    expect($this->user->fresh()->last_logged_in_at)->toBeNull();

    $this->actingAs($this->user)->get(route('materials.index'));

    expect($this->user->fresh()->last_logged_in_at->isCurrentSecond())->not->toBeNull();

    $this->travel(5)->seconds();

    $this->actingAs($this->user)->get(route('materials.index'));

    expect($this->user->fresh()->last_logged_in_at->isCurrentSecond())->toBeTrue();
});
