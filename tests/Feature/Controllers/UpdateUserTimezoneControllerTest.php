<?php

declare(strict_types=1);

use App\Models\User;

test('guests timezone can be updated', function () {
    $newTimezone = 'Asia/Riyadh';

    $response = $this->post(route('timezone.update'), [
        'timezone' => $newTimezone,
    ]);

    $response
        ->assertStatus(204)
        ->assertSessionHas('timezone', $newTimezone);
});

test('auth users timezone can be updated', function () {
    $user = User::factory()->create();
    $newTimezone = 'Asia/Riyadh';

    $response = $this->actingAs($user)->post(route('timezone.update'), [
        'timezone' => $newTimezone,
    ]);

    $response->assertStatus(204);

    expect($user->fresh()->timezone)->toBe($newTimezone);
});

test('timezone must be valid', function () {
    $response = $this->post(route('timezone.update'), [
        'timezone' => 'nowhere/nowhere',
    ]);

    $response->assertStatus(302);
});
