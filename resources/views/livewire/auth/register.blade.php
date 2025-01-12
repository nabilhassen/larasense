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

            <label class="form-control w-full">
                <div class="label">
                    <span>Name</span>
                </div>
                <input
                    wire:model="name"
                    id="name"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                    type="text"
                    name="name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <x-input-error
                    :messages="$errors->get('name')"
                    class="mt-2"
                />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span>Email</span>
                </div>
                <input
                    wire:model="email"
                    id="email"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                    type="email"
                    name="email"
                    required
                    autocomplete="username"
                />
                <x-input-error
                    :messages="$errors->get('email')"
                    class="mt-2"
                />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span>Password</span>
                </div>
                <input
                    wire:model="password"
                    id="password"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                />
                <x-input-error
                    :messages="$errors->get('password')"
                    class="mt-2"
                />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span>Confirm Password</span>
                </div>
                <input
                    wire:model="password_confirmation"
                    id="password_confirmation"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <x-input-error
                    :messages="$errors->get('password_confirmation')"
                    class="mt-2"
                />
            </label>

            <div class="flex items-center justify-end !mt-8">
                <button class="btn bg-primary border-none text-white hover:bg-primary hover:brightness-90 w-full disabled:bg-primary disabled:opacity-70 disabled:text-white">
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
