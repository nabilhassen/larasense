<?php

namespace App\Livewire\Marketing;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Terms and Conditions')]
#[Layout('components.layouts.guest')]
class Terms extends Component
{
    public function render()
    {
        return view('livewire.marketing.terms');
    }
}
