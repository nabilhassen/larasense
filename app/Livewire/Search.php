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

    public function getMaterials(): Collection
    {
        if (blank($this->query)) {
            $this->material = null;
            return collect();
        }

        return Material::query()
            ->displayed()
            ->latest('published_at')
            ->whereAny([
                'title',
                'description',
            ], 'like', "%$this->query%")
            ->select([
                'id',
                'source_id',
                'slug',
                'title',
                'image_url',
                'published_at',
            ])
            ->with([
                'source:id,type,publisher_id' => [
                    'publisher:id,name,logo',
                ],
            ])
            ->limit(6)
            ->get();
    }

    public function view(string $slug): void
    {
        $this->material = Material::slug($slug)
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
                'source:id,type,publisher_id' => [
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
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.search', [
            'materials' => $this->getMaterials(),
        ]);
    }
}
