<div class="flex flex-col border-2 border-secondary hover:border-primary cursor-pointer p-4 rounded-xl space-y-4">
    <div class="flex justify-between items-center">
        <div class="avatar">
            <div class="w-8 rounded-full">
                <img src="{{ asset('storage/' . $material->source->publisher->logo) }}" />
            </div>
        </div>
        <div>
            @if ($material->isArticle())
                <span class="inline-flex items-center justify-center mx-0 size-8 rounded-full bg-stone-700">
                    <x-heroicon-o-pencil-square class="inline size-4 stroke-white" />
                </span>
            @elseif ($material->isYoutube())
                <span class="inline-flex items-center justify-center mx-0 size-8 rounded-full bg-red-500">
                    <x-heroicon-o-video-camera class="inline size-4 stroke-white fill-white" />
                </span>
            @elseif ($material->isPodcast())
                <span class="inline-flex items-center justify-center mx-0 size-8 rounded-full bg-purple-500">
                    <x-heroicon-o-microphone class="inline size-4 stroke-white" />
                </span>
            @endif
        </div>
    </div>
    <figure>
        <img
            src="{{ asset('storage/' . ($material->image_url ?? $material->source->publisher->logo)) }}"
            alt=""
            class="rounded-box w-full h-40 object-cover"
        >
    </figure>
    <div class="flex gap-x-1 text-xs opacity-70">
        <div>
            {{ $material->published_at->inUserTimezone()->toFormattedDateString() }}
        </div>
        <div>
            ·
        </div>
        <div>
            5mins
        </div>
    </div>
    <div class="flex-1">
        <h1 class="font-bold text-sm line-clamp-2">
            {!! $material->title !!}
        </h1>
        <h2 class="text-xs line-clamp-2">
            {!! $material->description !!}
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
            <button
                class="btn btn-sm btn-primary btn-outline text-xs hover:!text-white"
                x-data
                x-on:click="$dispatch('open_modal')"
            >
                Expand
            </button>
            <button class="btn btn-sm btn-primary btn-circle">
                <x-heroicon-s-play class="size-4 stroke-white fill-white" />
            </button>
        </div>
    </div>
</div>