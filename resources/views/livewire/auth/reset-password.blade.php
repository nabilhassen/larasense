<div class="min-h-screen flex justify-center items-center">
    <div class="sm:max-w-sm sm:mx-auto mx-4 py-8 space-y-6 border-2 border-secondary p-8 rounded-box shadow-lg">
        <figure>
            <a href="{{ route('home') }}">
                <img
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
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Email</span>
                </div>
                <input
                    wire:model="email"
                    id="email"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10"
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
                    <span class="label-text">Password</span>
                </div>
                <input
                    wire:model="password"
                    id="password"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10"
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
                    <span class="label-text">Confirm Password</span>
                </div>
                <input
                    wire:model="password_confirmation"
                    id="password_confirmation"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10"
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
                <button class="btn bg-primary border-primary text-white hover:bg-primary hover:brightness-90 w-full disabled:bg-primary disabled:opacity-70 disabled:text-white">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
