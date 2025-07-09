<?php

declare(strict_types=1);

use App\Livewire\SuggestSourceModal;
use App\Models\SourceSuggestion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

test('auth user can suggest sources', function () {
    $sourceSuggestion = SourceSuggestion::factory()->make();

    Livewire::test(SuggestSourceModal::class)
        ->set('url', $sourceSuggestion->url)
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('isSubmitted', true);

    $this->assertDatabaseHas('source_suggestions', [
        'url' => $sourceSuggestion->url,
        'user_id' => $this->user->id,
    ]);
});

test('guest user can suggest sources', function () {
    Auth::logout();

    $sourceSuggestion = SourceSuggestion::factory()->make();

    Livewire::test(SuggestSourceModal::class)
        ->set('url', $sourceSuggestion->url)
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('isSubmitted', true);

    $this->assertDatabaseHas('source_suggestions', [
        'url' => $sourceSuggestion->url,
        'user_id' => null,
    ]);
});

test('url is required', function () {
    Livewire::test(SuggestSourceModal::class)
        ->call('submit')
        ->assertHasErrors(['url' => ['required']]);
});
