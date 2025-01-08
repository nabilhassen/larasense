<?php

namespace App\Livewire\Materials;

use App\Livewire\Traits\HasEngagementMetrics;
use App\Models\Material;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Show extends Component
{
    use HasEngagementMetrics;

    #[Locked]
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
