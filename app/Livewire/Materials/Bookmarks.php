<?php

namespace App\Livewire\Materials;

use App\Livewire\Traits\CanLoadMore;
use App\Models\Material;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Bookmarks')]
#[Layout('components.layouts.app')]
class Bookmarks extends Component
{
    use CanLoadMore;

    public function render()
    {
        return view('livewire.materials.bookmarks', [
            'materials' => Material::feedQuery()
                ->whereHasBookmark(auth()->user())
                ->cursorPaginate($this->perPage),
        ]);
    }
}
