<?php

namespace App\Livewire\Traits;

trait CanLoadMore
{
    public int $perPage = 6;

    public function loadMore(): void
    {
        $this->perPage = $this->perPage > 100 ? 100 : ($this->perPage + 6);
    }
}
