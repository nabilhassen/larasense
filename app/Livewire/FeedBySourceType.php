<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\SourceType;
use App\Livewire\Traits\CanLoadMore;
use App\Models\Material;
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
                    'published_at',
                ])
                ->cursorPaginate($this->perPage),
        ])->title(str($this->type->value)->headline());
    }
}
