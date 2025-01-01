<div class="w-1/5 max-lg:hidden">
    <div class="fixed py-6 flex flex-col space-y-12 h-screen w-fit">
        <figure class="h-12 flex items-center">
            <a href="{{ route('dashboard') }}">
                <img
                    class="sm:w-52 w-48"
                    src="{{ asset('img/logo.png') }}"
                    alt="Larasense logo"
                >
            </a>
        </figure>
        <div class="space-y-4">
            <a
                wire:navigate
                href="{{ route('dashboard') }}"
                class="flex items-center gap-x-3 p-3 font-semibold {{ request()->routeIs('dashboard') ? 'bg-primary text-white rounded-btn' : 'hover:bg-secondary dark:hover:bg-stone-900 hover:rounded' }}"
            >
                <x-heroicon-o-home class="inline-block size-6" />
                <span>
                    Home
                </span>
            </a>
            <a
                wire:navigate
                href="{{ route('likes') }}"
                class="flex items-center gap-x-3 p-3 font-semibold {{ request()->routeIs('likes') ? 'bg-primary text-white rounded-btn' : 'hover:bg-secondary dark:hover:bg-stone-900 hover:rounded' }}"
            >
                <x-heroicon-o-hand-thumb-up class="inline-block size-6" />
                <span>
                    Likes
                </span>
            </a>
            <a
                wire:navigate
                href="{{ route('bookmarks') }}"
                class="flex items-center gap-x-3 p-3 font-semibold {{ request()->routeIs('bookmarks') ? 'bg-primary text-white rounded-btn' : 'hover:bg-secondary dark:hover:bg-stone-900 hover:rounded' }}"
            >
                <x-heroicon-o-bookmark class="inline-block size-6" />
                <span>
                    Bookmarks
                </span>
            </a>
            <a
                wire:navigate
                href="{{ route('settings') }}"
                class="flex items-center gap-x-3 p-3 font-semibold {{ request()->routeIs('settings') ? 'bg-primary text-white rounded-btn' : 'hover:bg-secondary dark:hover:bg-stone-900 hover:rounded' }}"
            >
                <x-heroicon-o-cog-6-tooth class="inline-block size-6" />
                <span>
                    Settings
                </span>
            </a>
        </div>
        <div class="flex-1 flex flex-col justify-end items-start">
            <button class="btn btn-sm btn-primary btn-link">
                Suggest sources
            </button>
            <button class="btn btn-sm btn-primary btn-link">
                Report bugs
            </button>
        </div>
    </div>
</div>
