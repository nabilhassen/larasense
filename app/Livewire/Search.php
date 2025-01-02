<?php

namespace App\Livewire;

use App\Livewire\Traits\HasEngagementMetrics;
use App\Models\Material;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class Search extends Component
{
    use HasEngagementMetrics;

    public ?string $query = '';

    public ?Material $material = null;

    public function boot()
    {
        $this->material = null;
    }

    public function getMaterials(): Collection
    {
        $searchQuery = str($this->query)->squish()->replace(' ', '%%');

        return Material::feedQuery()
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

    public function view(string $slug): void
    {
        $this->material = Material::feedQuery()
            ->addSelect('duration')
            ->slug($slug)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.search', [
            'materials' => $this->getMaterials(),
        ]);
    }
}
