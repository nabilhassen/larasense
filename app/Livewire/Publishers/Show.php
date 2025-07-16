<?php

declare(strict_types=1);

namespace App\Livewire\Publishers;

use App\Livewire\Traits\CanLoadMore;
use App\Models\Publisher;
use Livewire\Component;

class Show extends Component
{
    use CanLoadMore;

    public Publisher $publisher;

    public function mount(string $slug)
    {
        $this->publisher = Publisher::displayed()->where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.publishers.show', [
            'materials' => $this->publisher
                ->materials()
                ->displayed()
                ->latest('published_at')
                ->cursorPaginate($this->perPage, [
                    'materials.id',
                    'materials.slug',
                    'materials.published_at',
                ]),
        ])->title($this->publisher->name);
    }
}
