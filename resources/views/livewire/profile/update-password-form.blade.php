<section class="space-y-4">
    <div>
        <h1 class="font-semibold">
            Update Password
        </h1>
        <h2 class="text-sm">
            Ensure your account is using a long, random password to stay secure.
        </h2>
    </div>
    <form
        wire:submit="updatePassword"
        class="space-y-2"
    >
        <fieldset class="fieldset">
            <label class="label text-base">Current Password</label>
            <input
                wire:model="current_password"
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="input shadow-none focus:outline-hidden focus:border-2 focus:border-primary h-10 dark:bg-stone-900 w-full"
                autocomplete="current-password"
            />
            @error('current_password')
                <p class="label text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </fieldset>

        <fieldset class="fieldset">
            <label class="label text-base">New Password</label>
            <input
                wire:model="password"
                id="update_password_password"
                name="password"
                type="password"
                class="input shadow-none focus:outline-hidden focus:border-2 focus:border-primary h-10 dark:bg-stone-900 w-full"
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
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="input shadow-none focus:outline-hidden focus:border-2 focus:border-primary h-10 dark:bg-stone-900 w-full"
                autocomplete="new-password"
            />
            @error('password_confirmation')
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
                on="password-updated"
            >
                Saved.
            </x-action-message>
        </div>
    </form>
</section>
