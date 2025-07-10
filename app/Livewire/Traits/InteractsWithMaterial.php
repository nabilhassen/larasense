<?php

declare(strict_types=1);

namespace App\Livewire\Traits;

use App\Models\Material;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Renderless;
use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Like;
use Maize\Markable\Models\Reaction;

trait InteractsWithMaterial
{
    #[Computed]
    public function material(): Material
    {
        return Material::slug($this->slug)->firstOrFail();
    }

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
        if (! auth()->check()) {
            return;
        }

        DB::transaction(function () {
            Reaction::remove(
                $this->material,
                auth()->user(),
                Material::DISLIKE_REACTION,
            );

            Like::add(
                $this->material,
                auth()->user()
            );
        });
    }

    #[Renderless]
    public function unlike(): void
    {
        if (! auth()->check()) {
            return;
        }

        Like::remove(
            $this->material,
            auth()->user()
        );
    }

    #[Computed]
    public function isLiked(): bool
    {
        if (! auth()->check()) {
            return false;
        }

        return Like::has(
            $this->material,
            auth()->user()
        );
    }

    #[Computed]
    public function likesCount(): int
    {
        return Like::count(
            $this->material
        );
    }

    #[Renderless]
    public function dislike(): void
    {
        if (! auth()->check()) {
            return;
        }

        DB::transaction(function () {
            Like::remove(
                $this->material,
                auth()->user()
            );

            Reaction::add(
                $this->material,
                auth()->user(),
                Material::DISLIKE_REACTION,
            );
        });
    }

    #[Renderless]
    public function undislike(): void
    {
        if (! auth()->check()) {
            return;
        }

        Reaction::remove(
            $this->material,
            auth()->user(),
            Material::DISLIKE_REACTION,
        );
    }

    #[Computed]
    public function isDisliked(): bool
    {
        if (! auth()->check()) {
            return false;
        }

        return Reaction::has(
            $this->material,
            auth()->user(),
            Material::DISLIKE_REACTION,
        );
    }

    #[Renderless]
    public function bookmark(): void
    {
        if (! auth()->check()) {
            return;
        }

        Bookmark::add(
            $this->material,
            auth()->user()
        );
    }

    #[Renderless]
    public function unbookmark(): void
    {
        if (! auth()->check()) {
            return;
        }

        Bookmark::remove(
            $this->material,
            auth()->user()
        );
    }

    #[Computed]
    public function isBookmarked(): bool
    {
        if (! auth()->check()) {
            return false;
        }

        return Bookmark::has(
            $this->material,
            auth()->user()
        );
    }
}
