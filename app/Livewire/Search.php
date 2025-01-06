<?php

namespace App\Livewire;

use App\Models\Material;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class Search extends Component
{
    public ?string $query = '';

    public function getMaterials(): Collection
    {
        $searchQuery = str($this->query)->squish()->replace(' ', '%%');

        if (blank($searchQuery)) {
            return collect();
        }

        return Material::displayed()
            ->latest('published_at')
            ->select([
                'id',
                'source_id',
                'slug',
                'title',
                'published_at',
                'image_url',
            ])
            ->with([
                'source:id,publisher_id,type' => [
                    'publisher:id,name,logo',
                ],
            ])
            ->whereAny([
                'title',
                'description',
            ], 'LIKE', "%$searchQuery%")
            ->orWhereHas('source', function (Builder $query) use ($searchQuery) {
                $query->whereLike('type', "%$searchQuery%")
                    ->orWhereRelation('publisher', 'name', 'LIKE', "%$searchQuery%");
            })
            ->limit(6)
            ->get();
    }

    public function render()
    {
        return view('livewire.search', [
            'materials' => $this->getMaterials(),
        ]);
    }
}
