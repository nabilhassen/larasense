<?php

declare(strict_types=1);

namespace App\Livewire\Materials;

use App\Livewire\Traits\InteractsWithMaterial;
use App\Models\Material;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component
{
    use InteractsWithMaterial;

    #[Locked]
    public string $slug = '';

    #[On('open-material-modal')]
    public function setSlug(?string $slug = ''): void
    {
        if (blank($slug)) {
            $this->skipRender();

            return;
        }

        $this->slug = $slug;
    }

    public function render()
    {
        return view('livewire.materials.modal', [
            'material' => Material::feedQuery()
                ->slug($this->slug)
                ->first(),
        ]);
    }
}
