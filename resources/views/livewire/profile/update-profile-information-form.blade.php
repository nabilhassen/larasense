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
        <label class="form-control w-full">
            <div class="label">
                <span>Name</span>
            </div>
            <input
                wire:model="name"
                id="name"
                name="name"
                type="text"
                class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                required
                autofocus
                autocomplete="name"
            />
            @error('name')
                <div class="text-sm text-red-500 mt-2">
                    {{ $message }}
                </div>
            @enderror
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
                @readonly(auth()->user()->isRegisteredWithProvider())
            />
            @error('email')
                <div class="text-sm text-red-500 mt-2">
                    {{ $message }}
                </div>
            @enderror
        </label>

        <div class="flex items-center gap-4 !mt-8">
            <button class="btn bg-primary text-white hover:bg-primary border-none hover:brightness-90 disabled:bg-primary disabled:opacity-70 disabled:text-white">
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
