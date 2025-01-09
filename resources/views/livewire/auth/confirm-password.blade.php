<div class="lg:w-1/2 space-y-8">
    <h2 class="font-semibold text-xl leading-tight py-3 border-b border-stone-200 dark:border-stone-900">
        Confirm Password
    </h2>
    <div class="space-y-4">
        <div>
            <h1 class="font-semibold">
                Confirm Password
            </h1>
            <h2 class="text-sm">
                This is a secure area of the application. Please confirm your password before continuing.
            </h2>
        </div>
        <form
            wire:submit="confirmPassword"
            class="space-y-2"
        >
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
                    autocomplete="current-password"
                />
                @error('password')
                    <div class="text-sm text-red-500 mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </label>

            <div class="flex items-center justify-end !mt-8">
                <button class="btn bg-primary border-none text-white hover:bg-primary hover:brightness-90 w-full disabled:bg-primary disabled:opacity-70 disabled:text-white">
                    Confirm
                </button>
            </div>
        </form>
    </div>
</div>
