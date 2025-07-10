<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;
use Mockery\MockInterface;

test('redirects to auth provider', function () {
    $this
        ->get(route('socialite.redirect', 'github'))
        ->assertValid()
        ->assertRedirect();
});

test('provider is invalid', function () {
    $this
        ->get(route('socialite.redirect', Str::random()))
        ->assertInvalid(['provider']);
});

test('handles callback from auth provider and creates a user', function () {
    $provider = Arr::random(['github', 'google']);
    $user = User::factory()->unverified()->make();

    Event::fake();

    $socialiteUser = $this->mock(SocialiteUser::class, function (MockInterface $mock) use ($user) {
        $mock->id = fake()->randomNumber(3);
        $mock->name = $user->name;
        $mock->email = $user->email;
        $mock->avatar = $user->avatar_url;
    });

    $socialiteProvider = $this->mock(Provider::class, function (MockInterface $mock) use ($socialiteUser) {
        $mock->shouldReceive('user')->andReturn($socialiteUser);
    });

    Socialite::shouldReceive('driver')->with($provider)->andReturn($socialiteProvider);

    $this->assertDatabaseCount('users', 0);

    $this
        ->get(route('socialite.callback', $provider))
        ->assertRedirect(route('materials.index'));

    Event::assertDispatched(Verified::class);

    $this
        ->assertAuthenticated()
        ->assertDatabaseCount('users', 1)
        ->assertDatabaseHas('users', [
            'provider' => $provider,
            'provider_id' => $socialiteUser->id,
            'name' => $socialiteUser->name,
            'email' => $socialiteUser->email,
            'avatar_url' => $socialiteUser->avatar,
        ])
        ->assertTrue(User::firstWhere('email', $user->email)->hasVerifiedEmail());
});

test('user will not be created if already registered via registration form', function () {
    $provider = Arr::random(['github', 'google']);
    $user = User::factory()->create();
    $this->assertDatabaseCount('users', 1);

    $socialiteUser = $this->mock(SocialiteUser::class, function (MockInterface $mock) use ($user) {
        $mock->id = fake()->randomNumber(3);
        $mock->name = $user->name;
        $mock->email = $user->email;
        $mock->avatar = $user->avatar_url;
    });

    $socialiteProvider = $this->mock(Provider::class, function (MockInterface $mock) use ($socialiteUser) {
        $mock->shouldReceive('user')->andReturn($socialiteUser);
    });

    Socialite::shouldReceive('driver')->with($provider)->andReturn($socialiteProvider);

    $this
        ->get(route('socialite.callback', $provider))
        ->assertInvalid([
            'email' => 'This email is already taken.',
        ]);

    $this->assertDatabaseCount('users', 1);
});

test('user will login and will not be created again if already registered with the same socialite', function () {
    $user = User::factory()->viaSocialite()->create();
    $newName = fake()->name();

    $socialiteUser = $this->mock(SocialiteUser::class, function (MockInterface $mock) use ($user, $newName) {
        $mock->id = $user->provider_id;
        $mock->name = $newName;
        $mock->email = $user->email;
        $mock->avatar = $user->avatar_url;
    });

    $socialiteProvider = $this->mock(Provider::class, function (MockInterface $mock) use ($socialiteUser) {
        $mock->shouldReceive('user')->andReturn($socialiteUser);
    });

    Socialite::shouldReceive('driver')->with($user->provider)->andReturn($socialiteProvider);

    $this->assertDatabaseCount('users', 1);

    $this
        ->get(route('socialite.callback', $user->provider))
        ->assertRedirect(route('materials.index'));

    $this
        ->assertAuthenticated()
        ->assertDatabaseCount('users', 1)
        ->assertDatabaseHas('users', [
            'provider' => $user->provider,
            'provider_id' => $socialiteUser->id,
            'name' => $newName,
            'email' => $socialiteUser->email,
            'avatar_url' => $socialiteUser->avatar,
        ]);
});

test('user will not be created if already registered with another socialite', function () {
    $user = User::factory()->viaSocialite()->create();
    $provider = collect(['google', 'github'])->diff([$user->provider])->random();
    $this->assertDatabaseCount('users', 1);

    $socialiteUser = $this->mock(SocialiteUser::class, function (MockInterface $mock) use ($user) {
        $mock->id = fake()->randomNumber(3);
        $mock->name = $user->name;
        $mock->email = $user->email;
        $mock->avatar = $user->avatar_url;
    });

    $socialiteProvider = $this->mock(Provider::class, function (MockInterface $mock) use ($socialiteUser) {
        $mock->shouldReceive('user')->andReturn($socialiteUser);
    });

    Socialite::shouldReceive('driver')->with($provider)->andReturn($socialiteProvider);

    $this
        ->get(route('socialite.callback', $provider))
        ->assertInvalid([
            'email' => 'This email is already taken.',
        ]);

    $this->assertDatabaseCount('users', 1);
});
