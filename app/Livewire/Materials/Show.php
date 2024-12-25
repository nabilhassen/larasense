<?php

namespace App\Livewire\Materials;

use App\Models\Material;
use Livewire\Component;

class Show extends Component
{
    public string $slug;

    public function render()
    {
        return view('livewire.materials.show', [
            'material' => Material::with('source.publisher')
                ->where('slug', $this->slug)
                ->firstOrFail(),
        ]);
    }
}
