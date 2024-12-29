<?php

namespace App\Livewire\Materials;

use App\Livewire\Traits\CanLoadMore;
use App\Livewire\Traits\HasEngagementMetrics;
use App\Models\Material;
use Livewire\Component;

class Index extends Component
{
    use CanLoadMore, HasEngagementMetrics;

    public function render()
    {
        return view('livewire.materials.index', [
            'materials' => Material::with(['source.publisher'])
                ->displayed()
                ->latest('published_at')
                ->cursorPaginate($this->perPage),
        ]);
    }
}
