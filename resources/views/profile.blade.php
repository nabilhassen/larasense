<x-layouts.app>
    <x-slot:title>Account Settings</x-slot>
    <div class="lg:w-1/2 space-y-8">
        <h2 class="font-semibold text-xl leading-tight py-3 border-b border-stone-200 dark:border-stone-900">
            Account Settings
        </h2>

        <div class="space-y-12">
            <div class="lg:w-2/4 lg:mx-auto">
                <livewire:profile.upload-profile-picture />
            </div>
            <div>
                <livewire:profile.update-profile-information-form />
            </div>
            <hr class="dark:border-stone-900">
            @if (!auth()->user()->isRegisteredWithProvider())
                <div>
                    <livewire:profile.update-password-form />
                </div>
                <hr class="dark:border-stone-900">
            @endif
            <div>
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</x-layouts.app>
