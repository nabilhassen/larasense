<div class="btm-nav lg:hidden">
    <button class="{{ request()->routeIs('dashboard') ? 'active border-t-primary' : '' }}">
        <x-heroicon-o-home class="inline-flex size-6 {{ request()->routeIs('dashboard') ? 'stroke-primary' : '' }}" />
    </button>
    <button>
        <x-heroicon-o-bookmark class="inline-flex size-6" />
    </button>
    <button>
        <x-heroicon-o-hand-thumb-up class="inline-flex size-6" />
    </button>
    <button>
        <x-heroicon-o-cog-6-tooth class="inline-flex size-6" />
    </button>
    <button>
        <x-heroicon-o-moon class="inline-flex size-6" />
    </button>
</div>
