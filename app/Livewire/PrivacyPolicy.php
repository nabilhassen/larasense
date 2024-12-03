<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Privacy Policy')]
class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.privacy-policy');
    }
}
