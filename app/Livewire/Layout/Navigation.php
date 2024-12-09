<?php

namespace App\Livewire\Layout;

use App\Actions\Logout;
use Livewire\Component;

class Navigation extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirectRoute('home');
    }

    public function render()
    {
        return view('livewire.layout.navigation');
    }
}
