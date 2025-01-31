<div class="sticky z-10 bg-white dark:bg-black border border-white dark:border-black top-0 py-4 lg:py-6 space-y-4">
    <div class="flex justify-between items-center">
        <figure class="lg:hidden">
            <a
                wire:navigate
                href="{{ auth()->check() ? route('materials.index') : route('home') }}"
            >
                <img
                    loading="lazy"
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
                <button
                    x-cloak
                    x-data
                    x-on:click="$store.themeMode.toggle()"
                >
                    <x-heroicon-o-sun
                        x-show="$store.themeMode.isDark()"
                        class="inline-flex size-8"
                    />
                    <x-heroicon-o-moon
                        x-show="!$store.themeMode.isDark()"
                        class="inline-flex size-8"
                    />
                </button>
            </div>
            @auth
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
                        class="dropdown-content menu bg-stone-50 dark:bg-stone-900 rounded-box z-[1] w-52 p-2 shadow"
                    >
                        <li>
                            <a
                                wire:navigate
                                class="hover:bg-accent dark:hover:bg-black active:!bg-accent dark:active:!bg-black focus:!bg-accent dark:focus:!bg-black active:!text-inherit"
                                href="{{ route('settings') }}"
                            >
                                Profile
                            </a>
                        </li>
                        <li class="lg:hidden">
                            <button
                                x-data
                                class="hover:bg-accent dark:hover:bg-black active:!bg-accent dark:active:!bg-black focus:!bg-accent dark:focus:!bg-black active:!text-inherit"
                                x-on:click="$dispatch('open-source-suggestions-modal')"
                            >
                                Suggest Sources
                            </button>
                        </li>
                        <li class="lg:hidden">
                            <button
                                x-data
                                class="hover:bg-accent dark:hover:bg-black active:!bg-accent dark:active:!bg-black focus:!bg-accent dark:focus:!bg-black active:!text-inherit"
                                x-on:click="$dispatch('open-bug-reports-modal')"
                            >
                                Report Bugs
                            </button>
                        </li>
                        <li class="lg:hidden">
                            <a
                                href="https://x.com/nabilhassen08"
                                class="hover:bg-accent dark:hover:bg-black active:!bg-accent dark:active:!bg-black focus:!bg-accent dark:focus:!bg-black active:!text-inherit"
                                target="_blank"
                            >
                                Roadmap
                            </a>
                        </li>
                        <li class="lg:hidden">
                            <button
                                x-data
                                x-cloak
                                class="hover:bg-accent dark:hover:bg-black active:!bg-accent dark:active:!bg-black focus:!bg-accent dark:focus:!bg-black active:!text-inherit"
                                x-text="$store.themeMode.isDark() ? 'Light Mode' : 'Dark Mode'"
                                x-on:click="$store.themeMode.toggle()"
                            ></button>
                        </li>
                        <li>
                            <livewire:auth.logout-button />
                        </li>
                    </ul>
                </div>
            @else
                <a
                    wire:navigate
                    class="btn btn-outline text-primary max-sm:hidden hover:bg-primary hover:border-primary"
                    href="{{ route('login') }}"
                >
                    Login
                </a>
                <a
                    wire:navigate
                    class="sm:hidden"
                    href="{{ route('login') }}"
                >
                    <x-heroicon-o-arrow-right-start-on-rectangle class="inline stroke-primary size-8" />
                </a>
            @endauth
        </div>
    </div>

    @persist('main-podcast-player')
        <x-main-podcast-player />
    @endpersist
</div>
