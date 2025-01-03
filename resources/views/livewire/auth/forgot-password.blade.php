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
            Forgot your password? No problem. Just let us know your email address and we will email you a
            password reset link that will allow you to choose a new one.
        </div>

        @if (session()->has('status'))
            <div class="rounded-md font-bold p-4 bg-secondary text-primary text-sm">
                We have emailed your password reset link.
            </div>
        @endif

        @if (!session()->has('status'))
            <form
                wire:submit="sendPasswordResetLink"
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

                <div class="flex items-center justify-end !mt-8">
                    <button class="btn bg-primary border-primary text-white hover:bg-primary hover:brightness-90 w-full disabled:bg-primary disabled:opacity-70 disabled:text-white">
                        Email Password Reset Link
                    </button>
                </div>
            </form>
            <div class="text-sm text-center">
                <span>Just remembered?</span>
                <a
                    class="link text-primary font-bold"
                    href="{{ route('login') }}"
                >Login</a>
            </div>
        @endif
    </div>
</div>
