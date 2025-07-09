<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\BugReport;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ReportBugsModal extends Component
{
    #[Rule('required|string')]
    public string $description = '';

    public bool $isSubmitted = false;

    public function submit(): void
    {
        $this->validate();

        BugReport::create([
            'user_id' => auth()->id() ?? null,
            'description' => $this->description,
        ]);

        $this->isSubmitted = true;

        $this->reset('description');
    }

    public function render()
    {
        return view('livewire.report-bugs-modal');
    }
}
