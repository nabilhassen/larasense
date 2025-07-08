<?php

namespace App\Livewire\Materials;

use App\Livewire\Traits\InteractWithMaterial;
use App\Models\Material;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Card extends Component
{
    use InteractWithMaterial;

    #[Locked]
    public string $slug;

    public function render()
    {
        return view('livewire.materials.card', [
            'material' => Material::feedQuery()
                ->slug($this->slug)
                ->firstOrFail(),
        ]);
    }
}
