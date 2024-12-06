<div class="min-h-screen flex justify-center items-center text-stone-700">
    <div class="sm:max-w-sm sm:mx-auto mx-4 py-8 space-y-6">
        <figure>
            <a href="{{ route('home') }}">
                <img
                    class="w-48 mx-auto"
                    src="{{ asset('img/logo.png') }}"
                    alt="Larasense logo"
                >
            </a>
        </figure>
        <h1 class="text-center text-xl font-semibold">
            Login
        </h1>
        <x-socialite-auth label="Login" />
        <div class="divider text-sm">OR</div>
        <form
            wire:submit="login"
            class="space-y-2"
        >
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Email</span>
                </div>
                <input
                    wire:model="form.email"
                    id="email"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10"
                    type="email"
                    name="email"
                    required
                    autofocus
                    autocomplete="username"
                />
                @error('form.email')
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
                    wire:model="form.password"
                    id="password"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />
                @error('form.password')
                    <div class="text-sm text-red-500 mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </label>

            <div class="flex items-center justify-between !mt-4">
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
            <div class="flex items-center justify-end !mt-8">
                <button class="btn bg-primary text-white hover:bg-primary hover:brightness-90 w-full disabled:bg-primary disabled:opacity-70 disabled:text-white">
                    Login
                </button>
            </div>
        </form>
        <div class="text-sm text-center">
            <span>Don't have an account?</span>
            <a
                class="link text-primary font-bold"
                href="{{ route('register') }}"
            >Sign up</a>
        </div>
    </div>
</div>
