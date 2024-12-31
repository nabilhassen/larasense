<div class="sticky z-10 bg-white border border-white top-0 py-4 lg:py-6 space-y-4">
    <div class="flex justify-between items-center">
        <figure class="lg:hidden">
            <a href="{{ route('dashboard') }}">
                <img
                    class="w-8"
                    src="{{ asset('favicon.png') }}"
                    alt="Larasense logo"
                >
            </a>
        </figure>
        <div class="w-8/12">
            <livewire:search />
        </div>
        <div class="flex items-center gap-x-6">
            <div class="flex items-center max-lg:hidden">
                <button>
                    <x-heroicon-o-moon class="inline-flex size-8" />
                </button>
            </div>
            <div class="dropdown dropdown-bottom dropdown-end">
                <div
                    tabindex="0"
                    role="button"
                    class="flex items-center gap-x-2"
                >
                    <div class="avatar">
                        <div class="w-8 rounded-full">
                            <livewire:user-avatar />
                        </div>
                    </div>
                    <div class="flex items-center">
                        <x-heroicon-o-chevron-down class="inline-flex size-5" />
                    </div>
                </div>
                <ul
                    tabindex="0"
                    class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow"
                >
                    <li>
                        <a
                            wire:navigate
                            class="hover:bg-secondary active:!bg-secondary focus:!bg-secondary active:!text-inherit"
                            href="{{ route('settings') }}"
                        >
                            Profile
                        </a>
                    </li>
                    <li>
                        <livewire:auth.logout-button />
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <x-main-podcast-player />
</div>
