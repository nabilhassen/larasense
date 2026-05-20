<div class="min-h-screen flex justify-center">
    <div class="sm:max-w-sm sm:mx-auto mx-4 py-8 space-y-6">
        <figure>
            <a
                wire:navigate
                href="{{ route('home') }}"
            >
                <img
                    loading="lazy"
                    class="w-48 mx-auto"
                    src="{{ asset('img/logo.png') }}"
                    alt="Larasense logo"
                >
            </a>
        </figure>
        <h1 class="text-center text-xl font-semibold">
            Login
        </h1>
        <x-socialite-auth />
        <div class="divider dark:divider-primary text-sm">OR</div>
        <form
            wire:submit="login"
            class="space-y-2"
        >
            <x-honeypot livewire-model="extraFields" />

            <fieldset class="fieldset">
                <label class="label text-base">Email</label>
                <input
                    wire:model="form.email"
                    id="email"
                    class="input shadow-none focus:outline-hidden focus:border-2 focus:border-primary h-10 dark:bg-stone-900 w-full"
                    type="email"
                    name="email"
                    required
                    autofocus
                    autocomplete="username"
                />
                @error('form.email')
                    <p class="label text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </fieldset>

            <fieldset class="fieldset">
                <label class="label text-base">Password</label>
                <input
                    wire:model="form.password"
                    id="password"
                    class="input shadow-none focus:outline-hidden focus:border-2 focus:border-primary h-10 dark:bg-stone-900 w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />
                @error('form.password')
                    <p class="label text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </fieldset>

            <div class="flex items-center justify-between mt-4!">
                <label
                    for="remember"
                    class="inline-flex items-center"
                >
                    <input
                        wire:model="form.remember"
                        id="remember"
                        type="checkbox"
                        class="checkbox checkbox-sm checkbox-primary"
                        name="remember"
                    >
                    <span class="ms-2 text-sm opacity-60">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a
                        class="link text-sm opacity-60"
                        href="{{ route('password.request') }}"
                        wire:navigate
                    >
                        Forgot your password?
                    </a>
                @endif
            </div>
            <div class="flex items-center justify-end mt-8!">
                <button class="btn shadow-none bg-primary border-none text-white hover:bg-primary hover:brightness-90 w-full disabled:bg-primary disabled:opacity-70 disabled:text-white">
                    Login
                </button>
            </div>
        </form>
        <div class="text-sm text-center">
            <span>Don't have an account?</span>
            <a
                wire:navigate
                class="link text-primary font-bold"
                href="{{ route('register') }}"
            >Sign up</a>
        </div>
    </div>
</div>
