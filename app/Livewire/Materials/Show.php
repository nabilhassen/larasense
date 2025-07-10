<?php

declare(strict_types=1);

namespace App\Livewire\Materials;

use App\Livewire\Traits\InteractsWithMaterial;
use App\Models\Material;
use Livewire\Component;

class Show extends Component
{
    use InteractsWithMaterial;

    public string $slug;

    public function render()
    {
        $material = Material::feedQuery()
            ->slug($this->slug)
            ->firstOrFail();

        return view('livewire.materials.show', compact('material'))
            ->title($material->title);
    }
}
