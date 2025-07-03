<div class="btm-nav dark:bg-black lg:hidden">
    <a
        wire:navigate
        href="{{ route('materials.index') }}"
        @class([
            'active dark:bg-black border-t-primary' => request()->routeIs([
                'feed',
                'materials.index',
            ]),
        ])
    >
        <x-heroicon-o-home @class([
            'inline-flex size-6',
            'stroke-primary' => request()->routeIs(['feed', 'materials.index']),
            'stroke-stone-800 dark:stroke-stone-200' => !request()->routeIs([
                'feed',
                'materials.index',
            ]),
        ]) />
    </a>
    <a
        wire:navigate
        href="{{ route('likes') }}"
        @class([
            'active dark:bg-black border-t-primary' => request()->routeIs('likes'),
        ])
    >
        <x-heroicon-o-hand-thumb-up @class([
            'inline-flex size-6',
            'stroke-primary' => request()->routeIs('likes'),
            'stroke-stone-800 dark:stroke-stone-200' => !request()->routeIs('likes'),
        ]) />
    </a>
    <a
        wire:navigate
        href="{{ route('bookmarks') }}"
        @class([
            'active dark:bg-black border-t-primary' => request()->routeIs('bookmarks'),
        ])
    >
        <x-heroicon-o-bookmark @class([
            'inline-flex size-6',
            'stroke-primary' => request()->routeIs('bookmarks'),
            'stroke-stone-800 dark:stroke-stone-200' => !request()->routeIs(
                'bookmarks'),
        ]) />
    </a>
    <a
        wire:navigate
        href="{{ route('settings') }}"
        @class([
            'active dark:bg-black border-t-primary' => request()->routeIs('settings'),
        ])
    >
        <x-heroicon-o-cog-6-tooth @class([
            'inline-flex size-6',
            'stroke-primary' => request()->routeIs('settings'),
            'stroke-stone-800 dark:stroke-stone-200' => !request()->routeIs('settings'),
        ]) />
    </a>
</div>
