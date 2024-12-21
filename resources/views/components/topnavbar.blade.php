<div class="max-lg:h-10">
    <div class="max-lg:h-fit max-lg:fixed max-lg:bg-white max-lg:inset-x-4 max-lg:z-10 max-lg:py-4">
        <div class="flex justify-between items-center">
            <figure class="lg:hidden">
                <a href="{{ route('dashboard') }}">
                    <img
                        class="w-10"
                        src="{{ asset('favicon.png') }}"
                        alt="Larasense logo"
                    >
                </a>
            </figure>
            <div class="w-3/5">
                <label class="input input-bordered h-10 flex items-center gap-2 bg-stone-50 border-0 focus:border focus-within:border !outline-none">
                    <input
                        type="text"
                        class="grow"
                        placeholder="Search"
                    />
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 16 16"
                        fill="currentColor"
                        class="h-4 w-4 opacity-70"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </label>
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
                            <div class="w-10 rounded-full">
                                <img src="{{ asset('storage/' . auth()->user()->avatar_url) }}" />
                            </div>
                        </div>
                        <div class="flex items-center">
                            <x-heroicon-o-chevron-down class="inline-flex size-6" />
                        </div>
                    </div>
                    <ul
                        tabindex="0"
                        class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow"
                    >
                        <li><a></a></li>
                        <li><a>Item 2</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
