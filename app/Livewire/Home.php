<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Your Hub for Laravel News, Trends & Updates')]
class Home extends Component
{
    public function render()
    {
        return view('livewire.home');
    }
}
