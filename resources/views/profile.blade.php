<x-layouts.app>
    <div class="w-1/2 space-y-8 py-4">
        <h2 class="font-semibold text-xl leading-tight py-3 border-b border-stone-200">
            Account Settings
        </h2>

        <div class="space-y-12">
            <div>
                <livewire:profile.update-profile-information-form />
            </div>
            <hr>
            <div>
                <livewire:profile.update-password-form />
            </div>
            <hr>
            <div>
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</x-layouts.app>
