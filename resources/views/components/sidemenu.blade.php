<div class="w-1/5 max-lg:hidden">
    <div class="fixed py-6 flex flex-col space-y-12 h-screen w-fit">
        <figure class="h-12 flex items-center">
            <a
                wire:navigate
                href="{{ auth()->check() ? route('materials.index') : route('home') }}"
            >
                <img
                    loading="lazy"
                    class="sm:w-52 w-48"
                    src="{{ asset('img/logo.png') }}"
                    alt="Larasense logo"
                >
            </a>
        </figure>
        <div class="space-y-4">
            <a
                wire:navigate
                href="{{ route('materials.index') }}"
                @class([
                    'flex items-center gap-x-3 p-3 font-semibold',
                    'bg-primary text-white rounded-btn' => request()->routeIs([
                        'feed',
                        'materials.index',
                    ]),
                    'hover:bg-accent dark:hover:bg-stone-900 hover:rounded' => !request()->routeIs(
                        ['feed', 'materials.index']),
                ])
            >
                <x-heroicon-o-home class="inline-block size-6" />
                <span>
                    Home
                </span>
            </a>
            <a
                wire:navigate
                href="{{ route('likes') }}"
                @class([
                    'flex items-center gap-x-3 p-3 font-semibold',
                    'bg-primary text-white rounded-btn' => request()->routeIs('likes'),
                    'hover:bg-accent dark:hover:bg-stone-900 hover:rounded' => !request()->routeIs(
                        'likes'),
                ])
            >
                <x-heroicon-o-hand-thumb-up class="inline-block size-6" />
                <span>
                    Likes
                </span>
            </a>
            <a
                wire:navigate
                href="{{ route('bookmarks') }}"
                @class([
                    'flex items-center gap-x-3 p-3 font-semibold',
                    'bg-primary text-white rounded-btn' => request()->routeIs('bookmarks'),
                    'hover:bg-accent dark:hover:bg-stone-900 hover:rounded' => !request()->routeIs(
                        'bookmarks'),
                ])
            >
                <x-heroicon-o-bookmark class="inline-block size-6" />
                <span>
                    Bookmarks
                </span>
            </a>
            <a
                wire:navigate
                href="{{ route('settings') }}"
                @class([
                    'flex items-center gap-x-3 p-3 font-semibold',
                    'bg-primary text-white rounded-btn' => request()->routeIs('settings'),
                    'hover:bg-accent dark:hover:bg-stone-900 hover:rounded' => !request()->routeIs(
                        'settings'),
                ])
            >
                <x-heroicon-o-cog-6-tooth class="inline-block size-6" />
                <span>
                    Settings
                </span>
            </a>
        </div>
        <div class="flex-1 flex flex-col justify-end items-start">
            <button
                x-data
                class="btn btn-sm btn-primary btn-link"
                x-on:click="$dispatch('open-source-suggestions-modal')"
            >
                Suggest sources
            </button>
            <button
                x-data
                class="btn btn-sm btn-primary btn-link"
                x-on:click="$dispatch('open-bug-reports-modal')"
            >
                Report bugs
            </button>
            <a
                href="https://x.com/nabilhassen08"
                class="btn btn-sm btn-primary btn-link"
                target="_blank"
            >
                Roadmap
            </a>
        </div>
    </div>
</div>
