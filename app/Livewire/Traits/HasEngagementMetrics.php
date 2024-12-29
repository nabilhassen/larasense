<?php

namespace App\Livewire\Traits;

use App\Models\Material;
use Livewire\Attributes\Renderless;

trait HasEngagementMetrics
{
    #[Renderless]
    public function viewed(string $slug): void
    {
        Material::slug($slug)->firstOrFail()->increment('views');
    }

    #[Renderless]
    public function expanded(string $slug): void
    {
        Material::slug($slug)->firstOrFail()->increment('expands');
    }

    #[Renderless]
    public function redirected(string $slug): void
    {
        Material::slug($slug)->firstOrFail()->increment('redirects');
    }

    #[Renderless]
    public function played(string $slug): void
    {
        Material::slug($slug)->firstOrFail()->increment('plays');
    }
}
