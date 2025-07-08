<?php

namespace App\Livewire\Materials;

use App\Livewire\Traits\CanLoadMore;
use App\Models\Material;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
class Index extends Component
{
    use CanLoadMore;

    public function mount()
    {
        if (auth()->check() && ! auth()->user()->hasVerifiedEmail()) {
            $this->redirect(route('verification.notice', absolute: false), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.materials.index', [
            'materials' => Material::displayed()
                ->latest('published_at')
                ->select([
                    'id',
                    'slug',
                ])
                ->cursorPaginate($this->perPage),
        ]);
    }
}
