<?php

namespace App\Livewire\Marketing\Home;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Your Hub for Laravel News, Trends & Updates')]
#[Layout('components.layouts.guest')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.marketing.home.index');
    }
}
