<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\SourceSuggestion;
use Livewire\Attributes\Rule;
use Livewire\Component;

class SuggestSourceModal extends Component
{
    #[Rule('required|string|max:100')]
    public string $url = '';

    public bool $isSubmitted = false;

    public function submit(): void
    {
        $this->validate();

        SourceSuggestion::create([
            'user_id' => auth()->id() ?? null,
            'url' => $this->url,
        ]);

        $this->isSubmitted = true;

        $this->reset('url');
    }

    public function render()
    {
        return view('livewire.suggest-source-modal');
    }
}
