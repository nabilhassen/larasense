<?php

use App\Livewire\ReportBugsModal;
use App\Models\BugReport;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

test('user can report bugs', function () {
    $bugReport = BugReport::factory()->make();

    Livewire::test(ReportBugsModal::class)
        ->set('description', $bugReport->description)
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('isSubmitted', true);

    $this->assertDatabaseHas('bug_reports', [
        'description' => $bugReport->description,
        'user_id' => $this->user->id,
    ]);
});

test('description is required', function () {
    Livewire::test(ReportBugsModal::class)
        ->call('submit')
        ->assertHasErrors(['description' => ['required']]);
});
