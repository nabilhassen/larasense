<?php

namespace App\Livewire\Materials;

use App\Models\Material;
use Livewire\Component;

class Index extends Component
{
    public int $perPage = 6;

    public function loadMore(): void
    {
        $this->perPage = $this->perPage > 100 ? 100 : ($this->perPage + 6);
    }

    public function render()
    {
        return view('livewire.materials.index', [
            'materials' => Material::with(['source.publisher'])
                ->displayed()
                ->latest('published_at')
                ->simplePaginate($this->perPage),
        ]);
    }
}
