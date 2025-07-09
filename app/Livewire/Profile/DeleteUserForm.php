<?php

declare(strict_types=1);

namespace App\Livewire\Profile;

use App\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class DeleteUserForm extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => [Rule::requiredIf(! auth()->user()->isRegisteredWithProvider()), 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirectRoute('home', navigate: true);
    }

    public function render()
    {
        return view('livewire.profile.delete-user-form');
    }
}
