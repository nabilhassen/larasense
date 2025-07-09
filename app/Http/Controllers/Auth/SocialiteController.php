<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController
{
    public function redirect(string $provider): RedirectResponse
    {
        $this->validate(compact('provider'));

        return Socialite::driver($provider)->redirect();
    }

    public function handleCallback(string $provider): RedirectResponse
    {
        $this->validate(compact('provider'));

        $user = Socialite::driver($provider)->user();

        try {
            $user = User::updateOrCreate([
                'provider' => $provider,
                'provider_id' => $user->id,
            ], [
                'name' => $user->name ?? $user->nickname ?? 'N/A',
                'email' => $user->email,
                'password' => Str::random(),
                'avatar_url' => $user->avatar,
                'timezone' => session()->get('timezone', 'UTC'),
            ]);
        } catch (UniqueConstraintViolationException $exception) {
            throw ValidationException::withMessages([
                'email' => 'This email is already taken.',
            ]);
        }

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        Auth::login($user, true);

        return redirect()->intended(route('materials.index'));
    }

    protected function validate(array $data): void
    {
        Validator::make($data, [
            'provider' => ['required', 'string', 'in:github,google'],
        ])->validate();
    }
}
