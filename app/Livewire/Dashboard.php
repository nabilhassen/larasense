<?php

namespace App\Livewire;

use App\Models\Material;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'materials' => Material::with(['source.publisher'])
                ->displayed()
                ->latest('published_at')
                ->get(),
        ]);
    }
}
