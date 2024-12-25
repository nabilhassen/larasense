<?php

namespace App\Livewire;

use App\Models\Material;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    public int $perPage = 6;

    public function loadMore(): void
    {
        $this->perPage = $this->perPage > 100 ? 100 : ($this->perPage + 6);
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'materials' => Material::displayed()
                ->latest('published_at')
                ->select(['slug'])
                ->simplePaginate($this->perPage),
        ]);
    }
}
