<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Material;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Search extends Component
{
    #[Rule(('nullable|string'))]
    public ?string $query = '';

    public function render()
    {
        return view('livewire.search', [
            'materials' => $this->getMaterials(),
        ]);
    }

    protected function getMaterials(): Collection
    {
        $this->validate();

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
}
