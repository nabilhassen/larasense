<?php

use App\Enums\DigestFrequency;
use App\Livewire\Profile\ChangeDigestFrequency;
use App\Models\User;
use Illuminate\Validation\Rules\Enum;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create()->refresh();

    $this->actingAs($this->user);
});

test('change digest frequency component renders successfully', function () {
    Livewire::test(ChangeDigestFrequency::class)
        ->assertStatus(200);
});

test('user has all frequency chosen by default', function () {
    Livewire::test(ChangeDigestFrequency::class)
        ->assertSet('frequency', $this->user->digest_frequency->value);

    expect($this->user->fresh()->digest_frequency->value)->toBe(DigestFrequency::All->value);
});

test('user can change digest frequency', function () {
    Livewire::test(ChangeDigestFrequency::class)
        ->assertSet('frequency', $this->user->digest_frequency->value)
        ->set('frequency', DigestFrequency::Monthly->value)
        ->call('change');

    expect($this->user->fresh()->digest_frequency->value)->toBe(DigestFrequency::Monthly->value);
});

it('does not allow nullable', function () {
    Livewire::test(ChangeDigestFrequency::class)
        ->assertSet('frequency', $this->user->digest_frequency->value)
        ->set('frequency', null)
        ->call('change')
        ->assertHasErrors([
            'frequency' => ['required'],
        ]);
});

it('does not allow unexpected digest frequencies', function () {
    Livewire::test(ChangeDigestFrequency::class)
        ->assertSet('frequency', $this->user->digest_frequency->value)
        ->set('frequency', fake()->word())
        ->call('change')
        ->assertHasErrors([
            'frequency' => [Enum::class],
        ]);
});
