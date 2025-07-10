<?php

declare(strict_types=1);

namespace App\Livewire\Materials;

use App\Livewire\Traits\InteractsWithMaterial;
use App\Models\Material;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Card extends Component
{
    use InteractsWithMaterial;

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
