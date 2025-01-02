<?php

namespace App\Livewire\Materials;

use App\Livewire\Traits\CanLoadMore;
use App\Models\Material;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Likes')]
#[Layout('components.layouts.app')]
class Likes extends Component
{
    use CanLoadMore;

    public function render()
    {
        return view('livewire.materials.likes', [
            'materials' => Material::feedQuery()
                ->whereHasLike(auth()->user())
                ->addSelect('duration')
                ->cursorPaginate($this->perPage),
        ]);
    }
}
