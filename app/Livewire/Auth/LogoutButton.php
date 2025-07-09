<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Actions\Logout;
use Livewire\Component;

class LogoutButton extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect(route('login'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.logout-button');
    }
}
