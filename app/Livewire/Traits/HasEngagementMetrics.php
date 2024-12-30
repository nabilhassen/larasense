<?php

namespace App\Livewire\Traits;

use App\Models\Material;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Renderless;
use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Like;
use Maize\Markable\Models\Reaction;

trait HasEngagementMetrics
{
    #[Renderless]
    public function viewed(): void
    {
        $this->material->increment('views');
    }

    #[Renderless]
    public function expanded(): void
    {
        $this->material->increment('expands');
    }

    #[Renderless]
    public function redirected(): void
    {
        $this->material->increment('redirects');
    }

    #[Renderless]
    public function played(): void
    {
        $this->material->increment('plays');
    }

    #[Renderless]
    public function like(): void
    {
        $material = $this->material;

        DB::transaction(function () use ($material) {
            Reaction::remove(
                $material,
                auth()->user(),
                Material::DISLIKE_REACTION,
            );

            Like::add(
                $material,
                auth()->user()
            );
        });
    }

    #[Renderless]
    public function unlike(): void
    {
        Like::remove(
            $this->material,
            auth()->user()
        );
    }

    #[Computed]
    public function isLiked(): bool
    {
        return $this->material->likes_exists;
    }

    #[Computed]
    public function likesCount(): bool
    {
        return $this->material->likes_count;
    }

    #[Renderless]
    public function dislike(): void
    {
        $material = $this->material;

        DB::transaction(function () use ($material) {
            Like::remove(
                $material,
                auth()->user()
            );

            Reaction::add(
                $material,
                auth()->user(),
                Material::DISLIKE_REACTION,
            );
        });
    }

    #[Renderless]
    public function undislike(): void
    {
        Reaction::remove(
            $this->material,
            auth()->user(),
            Material::DISLIKE_REACTION,
        );
    }

    #[Computed]
    public function isDisliked(): bool
    {
        return $this->material->dislikes_exists;
    }

    #[Renderless]
    public function bookmark(): void
    {
        Bookmark::add(
            $this->material,
            auth()->user()
        );
    }

    #[Renderless]
    public function unbookmark(): void
    {
        Bookmark::remove(
            $this->material,
            auth()->user()
        );
    }

    #[Computed]
    public function isBookmarked(): bool
    {
        return $this->material->bookmarks_exists;
    }
}
