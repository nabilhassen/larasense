<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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
                'name' => $user->name,
                'email' => $user->email,
                'password' => Str::random(),
                'avatar_url' => $user->avatar,
            ]);
        } catch (UniqueConstraintViolationException $exception) {
            return redirect()->back()->with('socialite_error', 'This email is already taken.');
        }

        Auth::login($user);

        return redirect(route('dashboard'));
    }

    protected function validate(array $data): void
    {
        Validator::make($data, [
            'provider' => ['required', 'string', 'in:github,google'],
        ])->validate();
    }
}
