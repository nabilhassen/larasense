<div class="w-1/5 lg:pt-6 max-lg:hidden">
    <div class="fixed space-y-12">
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
                href="http://"
                class="flex items-center gap-x-3 p-3 font-semibold {{ request()->routeIs('dashboard') ? 'bg-primary text-white rounded-btn' : 'hover:bg-secondary hover:rounded' }}"
            >
                <x-heroicon-o-home class="inline-block size-6" />
                <span>
                    Home
                </span>
            </a>
            <a
                href="http://"
                class="flex items-center gap-x-3 p-3 font-semibold hover:bg-secondary hover:rounded"
            >
                <div class="indicator">
                    <span class="indicator-item badge badge-primary text-white font-bold text-xs indicator-start">9+</span>
                    <button>
                        <x-heroicon-o-bell class="size-6" />
                    </button>
                </div>
                <span>
                    Notifications
                </span>
            </a>
            <a
                href="http://"
                class="flex items-center gap-x-3 p-3 font-semibold hover:bg-secondary hover:rounded"
            >
                <x-heroicon-o-bookmark class="inline-block size-6" />
                <span>
                    Bookmarks
                </span>
            </a>
            <a
                href="http://"
                class="flex items-center gap-x-3 p-3 font-semibold hover:bg-secondary hover:rounded"
            >
                <x-heroicon-o-hand-thumb-up class="inline-block size-6" />
                <span>
                    Upvotes
                </span>
            </a>
            <a
                href="http://"
                class="flex items-center gap-x-3 p-3 font-semibold hover:bg-secondary hover:rounded"
            >
                <x-heroicon-o-cog-6-tooth class="inline-block size-6" />
                <span>
                    Settings
                </span>
            </a>
        </div>
    </div>
</div>
