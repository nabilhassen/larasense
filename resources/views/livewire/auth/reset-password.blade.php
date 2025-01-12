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
                    autofocus
                />
                @error('email')
                    <div class="text-sm text-red-500 mt-2">
                        {{ $message }}
                    </div>
                @enderror
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
                @error('password')
                    <div class="text-sm text-red-500 mt-2">
                        {{ $message }}
                    </div>
                @enderror
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
                @error('password_confirmation')
                    <div class="text-sm text-red-500 mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </label>

            <div class="flex items-center justify-end !mt-8">
                <button class="btn bg-primary border-none text-white hover:bg-primary hover:brightness-90 w-full disabled:bg-primary disabled:opacity-70 disabled:text-white">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
