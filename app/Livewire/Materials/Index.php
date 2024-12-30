<?php

namespace App\Livewire\Materials;

use App\Livewire\Traits\CanLoadMore;
use App\Models\Material;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Index extends Component
{
    use CanLoadMore;

    public function render()
    {
        return view('livewire.materials.index', [
            'materials' => Material::query()
                ->displayed()
                ->latest('published_at')
                ->select([
                    'id',
                    'source_id',
                    'title',
                    'description',
                    'body',
                    'slug',
                    'url',
                    'image_url',
                    'published_at',
                ])
                ->with([
                    'source:id,publisher_id' => [
                        'publisher:id,name,logo',
                    ],
                ])
                ->withExists([
                    'likes',
                    'bookmarks',
                    'reactions AS dislikes_exists' => function (Builder $query) {
                        $query->where('value', Material::DISLIKE_REACTION);
                    },
                ])
                ->withCount(['likes'])
                ->cursorPaginate($this->perPage),
        ]);
    }
}
