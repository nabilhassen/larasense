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
        <div class="text-sm">
            Thanks for signing up! Before getting started, could you verify your email address by clicking
            on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        @if (session('status') === 'verification-link-sent')
            <div class="rounded-md font-bold p-4 bg-accent text-primary text-sm">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="flex items-center justify-between !mt-8">
            <button
                class="btn bg-primary border-none text-white hover:bg-primary hover:brightness-90 disabled:bg-primary disabled:opacity-70 disabled:text-white"
                wire:click="sendVerification"
            >
                Resend Verification Email
            </button>
            <button
                wire:click="logout"
                type="submit"
                class="link text-sm opacity-60"
            >
                Log Out
            </button>
        </div>
    </div>
</div>
