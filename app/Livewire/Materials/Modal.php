<?php
namespace App\Livewire\Materials;

use App\Livewire\Traits\InteractWithMaterial;
use App\Models\Material;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component
{
    use InteractWithMaterial;

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
