<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

#[Title('Login')]
#[Layout('components.layouts.guest')]
class Login extends Component
{
    use UsesSpamProtection;

    public LoginForm $form;

    public HoneypotData $extraFields;

    public function mount()
    {
        $this->extraFields = new HoneypotData;
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->protectAgainstSpam();

        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('materials.index', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
