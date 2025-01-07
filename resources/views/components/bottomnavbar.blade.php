<div class="btm-nav dark:bg-black lg:hidden">
    <a
        wire:navigate
        href="{{ route('dashboard') }}"
        class="{{ request()->routeIs('dashboard') ? 'active dark:bg-black border-t-primary' : '' }}"
    >
        <x-heroicon-o-home class="inline-flex size-6 {{ request()->routeIs('dashboard') ? 'stroke-primary' : 'stroke-stone-800 dark:stroke-stone-200' }}" />
    </a>
    <a
        wire:navigate
        href="{{ route('likes') }}"
        class="{{ request()->routeIs('likes') ? 'active dark:bg-black border-t-primary' : '' }}"
    >
        <x-heroicon-o-hand-thumb-up class="inline-flex size-6 {{ request()->routeIs('likes') ? 'stroke-primary' : 'stroke-stone-800 dark:stroke-stone-200' }}" />
    </a>
    <a
        wire:navigate
        href="{{ route('bookmarks') }}"
        class="{{ request()->routeIs('bookmarks') ? 'active dark:bg-black border-t-primary' : '' }}"
    >
        <x-heroicon-o-bookmark class="inline-flex size-6 {{ request()->routeIs('bookmarks') ? 'stroke-primary' : 'stroke-stone-800 dark:stroke-stone-200' }}" />
    </a>
    <a
        wire:navigate
        href="{{ route('settings') }}"
        class="{{ request()->routeIs('settings') ? 'active dark:bg-black border-t-primary' : '' }}"
    >
        <x-heroicon-o-cog-6-tooth class="inline-flex size-6 {{ request()->routeIs('settings') ? 'stroke-primary' : 'stroke-stone-800 dark:stroke-stone-200' }}" />
    </a>
</div>
