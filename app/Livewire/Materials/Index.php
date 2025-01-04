<?php

namespace App\Livewire\Materials;

use App\Livewire\Traits\CanLoadMore;
use App\Models\Material;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
#[Layout('components.layouts.app')]
class Index extends Component
{
    use CanLoadMore;

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
