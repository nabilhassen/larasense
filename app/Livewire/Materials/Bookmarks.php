<?php

namespace App\Livewire\Materials;

use App\Livewire\Traits\CanLoadMore;
use App\Models\Material;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Bookmarks extends Component
{
    use CanLoadMore;

    public function render()
    {
        return view('livewire.materials.bookmarks', [
            'materials' => Material::with(['source.publisher'])
                ->displayed()
                ->latest('published_at')
                ->whereHasBookmark(auth()->user())
                ->cursorPaginate($this->perPage),
        ]);
    }
}
