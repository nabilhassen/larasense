<?php

declare(strict_types=1);

namespace App\Livewire\Materials;

use App\Livewire\Traits\CanLoadMore;
use App\Models\Material;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Likes')]
class Likes extends Component
{
    use CanLoadMore;

    public function render()
    {
        return view('livewire.materials.likes', [
            'materials' => Material::displayed()
                ->latest('published_at')
                ->whereHasLike(auth()->user())
                ->select([
                    'id',
                    'slug',
                    'published_at',
                ])
                ->cursorPaginate($this->perPage),
        ]);
    }
}
