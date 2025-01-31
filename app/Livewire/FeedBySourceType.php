<?php

namespace App\Livewire;

use App\Enums\SourceType;
use App\Livewire\Traits\CanLoadMore;
use App\Models\Material;
use Livewire\Attributes\Title;
use Livewire\Component;

class FeedBySourceType extends Component
{
    use CanLoadMore;

    public SourceType $type;

    public function render()
    {
        return view('livewire.feed-by-source-type', [
            'materials' => Material::displayed()
                ->sourceType($this->type)
                ->latest('published_at')
                ->select([
                    'id',
                    'slug',
                ])
                ->cursorPaginate($this->perPage),
        ])->title(str($this->type->value)->headline());
    }
}
