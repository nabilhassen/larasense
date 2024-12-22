<div class="grid xl:grid-cols-3 lg:grid-cols-2 lg:gap-x-4 gap-y-8 pb-24 max-lg:pt-8">
    @foreach (range(1, 6) as $item)
        <div class="border-2 border-secondary hover:border-primary cursor-pointer p-4 rounded-xl space-y-4">
            <div>
                <span class="inline-flex items-center justify-center mx-0 size-7 rounded-full bg-stone-700">
                    <x-heroicon-o-pencil-square class="inline size-5 stroke-white" />
                </span>
            </div>
            <figure>
                <img
                    src="https://picsum.photos/600/320"
                    alt=""
                    class="aspect-video w-full rounded"
                >

            </figure>
            <div class="flex justify-between items-center text-sm">
                <div class="flex items-center gap-x-2 mr-4">
                    <div class="avatar">
                        <div class="w-6 rounded-full">
                            <img src="{{ asset('storage/' . auth()->user()->avatar_url) }}" />
                        </div>
                    </div>
                    <div>
                        {{ auth()->user()->name }}
                    </div>
                </div>
                <div class="opacity-70">
                    2h ago
                </div>
            </div>
            <div>
                <h1 class="font-bold text-sm">
                    The Request Object in Laravel
                </h1>
                <h2 class="text-xs">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem adipisci, repudiandae distinctio harum.
                </h2>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex gap-x-2">
                    <button class="inline-flex items-center gap-x-1">
                        <x-heroicon-o-hand-thumb-up class="inline-flex size-6 stroke-primary fill-primary" />
                        <span class="opacity-70 text-sm">
                            120
                        </span>
                    </button>
                    <button class="inline-flex">
                        <x-heroicon-o-hand-thumb-down class="inline-flex size-6 stroke-stone-800" />
                    </button>
                    <button class="inline-flex">
                        <x-heroicon-o-bookmark class="inline-flex size-6 stroke-stone-800" />
                    </button>
                </div>
                <div class="flex gap-x-2">
                    <button class="btn btn-sm btn-primary btn-outline text-white text-xs">
                        Expand
                    </button>
                    <button class="btn btn-sm btn-primary btn-circle">
                        <x-heroicon-s-play class="size-4 stroke-white fill-white" />
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>
