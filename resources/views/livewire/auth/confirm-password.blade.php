<div class="min-h-screen flex justify-center items-center text-stone-700">
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
        <div class="text-sm">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <form
            wire:submit="confirmPassword"
            class="space-y-2"
        >
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Password</span>
                </div>
                <input
                    wire:model="form.password"
                    id="password"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />
                @error('password')
                    <div class="text-sm text-red-500 mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </label>

            <div class="flex items-center justify-end !mt-8">
                <button class="btn bg-primary text-white hover:bg-primary hover:brightness-90 w-full disabled:bg-primary disabled:opacity-70 disabled:text-white">
                    Confirm
                </button>
            </div>
        </form>
    </div>
</div>
