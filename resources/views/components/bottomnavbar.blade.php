<div class="btm-nav dark:bg-black lg:hidden">
    <button class="{{ request()->routeIs('dashboard') ? 'active dark:bg-black border-t-primary' : '' }}">
        <x-heroicon-o-home class="inline-flex size-6 {{ request()->routeIs('dashboard') ? 'stroke-primary' : 'stroke-stone-800 dark:stroke-stone-400' }}" />
    </button>
    <button class="{{ request()->routeIs('bookmarks') ? 'active dark:bg-black border-t-primary' : '' }}">
        <x-heroicon-o-bookmark class="inline-flex size-6 {{ request()->routeIs('bookmarks') ? 'stroke-primary' : 'stroke-stone-800 dark:stroke-stone-400' }}" />
    </button>
    <button class="{{ request()->routeIs('likes') ? 'active dark:bg-black border-t-primary' : '' }}">
        <x-heroicon-o-hand-thumb-up class="inline-flex size-6 {{ request()->routeIs('likes') ? 'stroke-primary' : 'stroke-stone-800 dark:stroke-stone-400' }}" />
    </button>
    <button class="{{ request()->routeIs('settings') ? 'active dark:bg-black border-t-primary' : '' }}">
        <x-heroicon-o-cog-6-tooth class="inline-flex size-6 {{ request()->routeIs('settings') ? 'stroke-primary' : 'stroke-stone-800 dark:stroke-stone-400' }}" />
    </button>
</div>
