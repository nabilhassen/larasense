<?php
namespace App\Livewire\Profile;

use App\Enums\DigestFrequency;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ChangeDigestFrequency extends Component
{
    public string $frequency;

    public function mount()
    {
        $this->frequency = auth()->user()->digest_frequency->value;
    }

    public function change(): void
    {
        $this->validate([
            'frequency' => ['required', Rule::enum(DigestFrequency::class)],
        ]);

        auth()->user()->digest_frequency = $this->frequency;

        auth()->user()->save();

        $this->dispatch('digest-frequency-update');
    }

    public function render()
    {
        return view('livewire.profile.change-digest-frequency', [
            'frequencies' => DigestFrequency::cases(),
        ]);
    }
}
