<?php

namespace App\Livewire\Marketing;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Privacy Policy')]
#[Layout('components.layouts.guest')]
class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.marketing.privacy-policy');
    }
}
