<dialog
    id="modal1"
    class="modal lg:modal-top text-stone-800"
    x-data
    @open_modal.window="$el.showModal()"
>
    <div class="modal-box lg:max-w-6xl lg:mx-auto lg:h-full">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <div class="lg:w-8/12 mx-auto space-y-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-x-2 mr-4">
                    <div class="avatar">
                        <div class="w-12 rounded-full">
                            <img src="{{ asset('storage/' . auth()->user()->avatar_url) }}" />
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div>
                            {{ auth()->user()->name }}
                        </div>
                        <div class="text-sm opacity-70">
                            2h ago
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h1 class="font-bold text-2xl lg:text-3xl">
                    The Request Object in Laravel
                </h1>
                <h2 class="opacity-70">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem adipisci, repudiandae distinctio harum.
                </h2>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex gap-x-4">
                    <button class="inline-flex items-center gap-x-1">
                        <x-heroicon-o-hand-thumb-up class="inline-flex lg:size-8 size-6 stroke-primary fill-primary" />
                        <span class="opacity-70">
                            120
                        </span>
                    </button>
                    <button class="inline-flex">
                        <x-heroicon-o-hand-thumb-down class="inline-flex lg:size-8 size-6 stroke-stone-800" />
                    </button>
                    <button class="inline-flex">
                        <x-heroicon-o-bookmark class="inline-flex lg:size-8 size-6 stroke-stone-800" />
                    </button>
                    <button class="inline-flex">
                        <x-heroicon-o-link class="inline-flex lg:size-8 size-6 stroke-stone-800" />
                    </button>
                </div>
                <div>
                    <button class="btn max-lg:btn-sm max-lg:text-xs btn-primary text-white">
                        <x-heroicon-o-arrow-top-right-on-square class="lg:size-6 size-4" />
                        <span>
                            Read Post
                        </span>
                    </button>
                </div>
            </div>
            <hr class="!my-12">
            <figure class="flex justify-center rounded-box p-6 shadow-2xl">
                <img
                    src="https://picsum.photos/600/320"
                    alt=""
                    class="object-scale-down"
                >
            </figure>
            <div>
                <p>Laravel provides AsArrayObject and AsCollection casts to handle complex JSON attributes more effectively, enabling intuitive manipulation of nested data structures.</p>
                <p>These casts enable seamless manipulation of JSON data while maintaining clean, maintainable code. AsArrayObject provides array-like access, while AsCollection offers Laravel's powerful collection methods.</p>

                <hr>
                <p>The post <a href="https://laravel-news.com/json-attributes-array-casts">Working with JSON Attributes Using Laravel&#039;s Array Casts</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravelnewsletter.com">Laravel Newsletter</a> to get all the latest
                    Laravel articles like this directly in your inbox.</p>
            </div>
            <hr class="!my-12">
            <div class="flex justify-between items-center">
                <div class="flex gap-x-4">
                    <button class="inline-flex items-center gap-x-1">
                        <x-heroicon-o-hand-thumb-up class="inline-flex lg:size-8 size-6 stroke-primary fill-primary" />
                        <span class="opacity-70">
                            120
                        </span>
                    </button>
                    <button class="inline-flex">
                        <x-heroicon-o-hand-thumb-down class="inline-flex lg:size-8 size-6 stroke-stone-800" />
                    </button>
                    <button class="inline-flex">
                        <x-heroicon-o-bookmark class="inline-flex lg:size-8 size-6 stroke-stone-800" />
                    </button>
                    <button class="inline-flex">
                        <x-heroicon-o-link class="inline-flex lg:size-8 size-6 stroke-stone-800" />
                    </button>
                </div>
                <div>
                    <button class="btn max-lg:btn-sm max-lg:text-xs btn-primary text-white">
                        <x-heroicon-o-arrow-top-right-on-square class="lg:size-6 size-4" />
                        <span>
                            Read Post
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <form
        method="dialog"
        class="modal-backdrop backdrop-blur-sm"
    >
        <button>close</button>
    </form>
</dialog>
