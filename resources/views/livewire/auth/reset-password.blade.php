<div class="min-h-screen flex justify-center items-center">
    <div class="sm:max-w-sm sm:mx-auto mx-4 py-8 space-y-6 border-2 border-accent p-8 rounded-box shadow-lg">
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
        <form
            wire:submit="resetPassword"
            class="space-y-2"
        >
            <x-honeypot livewire-model="extraFields" />

            <fieldset class="fieldset">
                <label class="label text-base">Email</label>
                <input
                    wire:model="email"
                    id="email"
                    class="input shadow-none focus:outline-hidden focus:border-2 focus:border-primary h-10 dark:bg-stone-900 w-full"
                    type="email"
                    name="email"
                    required
                    autofocus
                />
                @error('email')
                    <p class="label text-red-500">
                        {{ $message }}
                    </p>
                @enderror
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
                @error('password')
                    <p class="label text-red-500">
                        {{ $message }}
                    </p>
                @enderror
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
                @error('password_confirmation')
                    <p class="label text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </fieldset>

            <div class="flex items-center justify-end mt-8!">
                <button class="btn shadow-none bg-primary border-none text-white hover:bg-primary hover:brightness-90 w-full disabled:bg-primary disabled:opacity-70 disabled:text-white">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
