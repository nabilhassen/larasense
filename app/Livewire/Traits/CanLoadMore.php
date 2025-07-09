<?php

declare(strict_types=1);

namespace App\Livewire\Traits;

use Livewire\Attributes\Locked;

trait CanLoadMore
{
    #[Locked]
    public int $perPage = 12;

    public function loadMore(): void
    {
        $this->perPage = $this->perPage > 100 ? 100 : ($this->perPage + 6);
    }
}
