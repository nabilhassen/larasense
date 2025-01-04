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
        Material::slug($this->slug)
            ->firstOrFail()
            ->increment('views');
    }

    #[Renderless]
    public function expanded(): void
    {
        Material::slug($this->slug)
            ->firstOrFail()
            ->increment('expands');
    }

    #[Renderless]
    public function redirected(): void
    {
        Material::slug($this->slug)
            ->firstOrFail()
            ->increment('redirects');
    }

    #[Renderless]
    public function played(): void
    {
        Material::slug($this->slug)
            ->firstOrFail()
            ->increment('plays');
    }

    #[Renderless]
    public function like(): void
    {
        $material = Material::slug($this->slug)->firstOrFail();

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
            Material::slug($this->slug)->firstOrFail(),
            auth()->user()
        );
    }

    #[Computed]
    public function isLiked(): bool
    {
        return Like::has(
            Material::slug($this->slug)->firstOrFail(),
            auth()->user()
        );
    }

    #[Computed]
    public function likesCount(): bool
    {
        return Like::count(
            Material::slug($this->slug)->firstOrFail()
        );
    }

    #[Renderless]
    public function dislike(): void
    {
        $material = Material::slug($this->slug)->firstOrFail();

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
            Material::slug($this->slug)->firstOrFail(),
            auth()->user(),
            Material::DISLIKE_REACTION,
        );
    }

    #[Computed]
    public function isDisliked(): bool
    {
        return Reaction::has(
            Material::slug($this->slug)->firstOrFail(),
            auth()->user(),
            Material::DISLIKE_REACTION,
        );
    }

    #[Renderless]
    public function bookmark(): void
    {
        Bookmark::add(
            Material::slug($this->slug)->firstOrFail(),
            auth()->user()
        );
    }

    #[Renderless]
    public function unbookmark(): void
    {
        Bookmark::remove(
            Material::slug($this->slug)->firstOrFail(),
            auth()->user()
        );
    }

    #[Computed]
    public function isBookmarked(): bool
    {
        return Bookmark::has(
            Material::slug($this->slug)->firstOrFail(),
            auth()->user()
        );
    }
}
