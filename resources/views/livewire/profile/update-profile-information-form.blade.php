<section class="space-y-4">
    <div>
        <h1 class="font-semibold">
            Profile Information
        </h1>
        <h2 class="text-sm">
            Update your account's profile information and email address.
        </h2>
    </div>
    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
        <div class="rounded-md p-4 bg-accent text-primary text-sm">
            @if (is_null(session('status')))
                <p>
                    Your email address is unverified.

                    <button
                        wire:click.prevent="sendVerification"
                        class="link font-bold"
                    >
                        Click here to re-send the verification email.
                    </button>
                </p>
            @endif

            @if (session('status') === 'verification-link-sent')
                <p class="font-bold">
                    A new verification link has been sent to your email address.
                </p>
            @endif
        </div>
    @endif
    <form
        wire:submit="updateProfileInformation"
        class="space-y-2"
    >
        <fieldset class="fieldset">
            <label class="label text-base">Name</label>
            <input
                wire:model="name"
                id="name"
                name="name"
                type="text"
                class="input shadow-none focus:outline-hidden focus:border-2 focus:border-primary h-10 dark:bg-stone-900 w-full"
                required
                autofocus
                autocomplete="name"
            />
            @error('name')
                <p class="label text-red-500">
                    {{ $message }}
                </p>
            @enderror
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
                @readonly(auth()->user()->isRegisteredWithProvider())
            />
            @error('email')
                <p class="label text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </fieldset>

        <div class="flex items-center gap-4 mt-8!">
            <button class="btn shadow-none bg-primary text-white hover:bg-primary border-none hover:brightness-90 disabled:bg-primary disabled:opacity-70 disabled:text-white">
                Save
            </button>
            <x-action-message
                class="me-3"
                on="profile-updated"
            >
                Saved.
            </x-action-message>
        </div>
    </form>
</section>
