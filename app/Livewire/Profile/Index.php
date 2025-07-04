<?php

namespace App\Livewire\Profile;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Account Settings')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.profile.index');
    }
}
