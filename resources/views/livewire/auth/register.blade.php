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
            Sign Up
        </h1>
        <x-socialite-auth />
        <div class="divider dark:divider-primary text-sm">OR</div>
        <form
            wire:submit="register"
            class="space-y-2"
        >
            <x-honeypot livewire-model="extraFields" />

            <fieldset class="fieldset">
                <label class="label text-base">Name</label>
                <input
                    wire:model="name"
                    id="name"
                    class="input shadow-none focus:outline-hidden focus:border-2 focus:border-primary h-10 dark:bg-stone-900 w-full"
                    type="text"
                    name="name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <x-input-error :messages="$errors->get('name')" />
            </fieldset>

            <fieldset class="fieldset">
                <label class="label text-base">Email</label>
                <input
                    wire:model="email"
                    id="email"
                    class="input shadow-none focus:outline-hidden focus:border-2 focus:border-primary h-10 dark:bg-stone-900 w-full"
                    type="email"
                    name="email"
                    required
                    autocomplete="username"
                />
                <x-input-error :messages="$errors->get('email')" />
            </fieldset>

            <fieldset class="fieldset">
                <label class="label text-base">Password</label>
                <input
                    wire:model="password"
                    id="password"
                    class="input shadow-none focus:outline-hidden focus:border-2 focus:border-primary h-10 dark:bg-stone-900 w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->get('password')" />
            </fieldset>

            <fieldset class="fieldset">
                <label class="label text-base">Confirm Password</label>
                <input
                    wire:model="password_confirmation"
                    id="password_confirmation"
                    class="input shadow-none focus:outline-hidden focus:border-2 focus:border-primary h-10 dark:bg-stone-900 w-full"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" />
            </fieldset>

            <div class="flex items-center justify-end mt-8!">
                <button class="btn shadow-none bg-primary border-none text-white hover:bg-primary hover:brightness-90 w-full disabled:bg-primary disabled:opacity-70 disabled:text-white">
                    Sign up
                </button>
            </div>
            <div class="opacity-60 text-sm">
                By signing up, you're agreeing to our <a
                    class="link"
                    href="{{ route('terms') }}"
                    target="_blank"
                >Terms & Conditions</a> and <a
                    class="link"
                    href="{{ route('privacy') }}"
                    target="_blank"
                >Privacy Policy</a>.
            </div>
        </form>
        <div class="text-sm text-center">
            <span>Already have an account?</span>
            <a
                wire:navigate
                class="link text-primary font-bold"
                href="{{ route('login') }}"
            >Login</a>
        </div>
    </div>
</div>
