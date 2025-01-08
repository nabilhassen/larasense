<?php

namespace App\Livewire\Traits;

use Livewire\Attributes\Locked;

trait CanLoadMore
{
    #[Locked]
    public int $perPage = 6;

    public function loadMore(): void
    {
        $this->perPage = $this->perPage > 100 ? 100 : ($this->perPage + 6);
    }
}
