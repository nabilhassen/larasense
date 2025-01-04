<?php

namespace App\Livewire\Materials;

use App\Livewire\Traits\HasEngagementMetrics;
use App\Models\Material;
use Livewire\Component;

class Show extends Component
{
    use HasEngagementMetrics;

    public string $slug;

    public function render()
    {
        return view('livewire.materials.show', [
            'material' => Material::feedQuery()
                ->slug($this->slug)
                ->firstOrFail(),
        ]);
    }
}
