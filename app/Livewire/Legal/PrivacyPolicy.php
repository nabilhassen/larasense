<?php

namespace App\Livewire\Legal;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Privacy Policy')]
#[Layout('components.layouts.guest')]
class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.legal.privacy-policy');
    }
}
