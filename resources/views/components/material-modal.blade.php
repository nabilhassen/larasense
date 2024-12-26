@props(['material'])

<dialog
    class="modal lg:modal-top text-stone-800"
    x-data="{ isMaterialModalOpen: false }"
    x-bind:class="{ 'modal-open': isMaterialModalOpen }"
    x-on:open-modal.window="$event.detail.slug === 'material.{{ $material->slug }}' ? isMaterialModalOpen = true : isMaterialModalOpen = false"
    x-on:keyup.escape.window="isMaterialModalOpen = false"
>
    <div class="modal-box lg:max-w-6xl lg:mx-auto lg:h-full">
        <button
            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
            x-on:click="isMaterialModalOpen = false"
        >✕</button>
        <div class="lg:w-8/12 mx-auto space-y-8">
            <div class="flex justify-between items-center">
                <div class="avatar">
                    <div class="w-12 rounded-full">
                        <img src="{{ asset('storage/' . $material->source->publisher->logo) }}" />
                    </div>
                </div>
                <div>
                    @if ($material->isArticle())
                        <span class="inline-flex items-center justify-center mx-0 size-12 rounded-full bg-stone-700">
                            <x-heroicon-o-pencil-square class="inline size-6 stroke-white" />
                        </span>
                    @elseif ($material->isYoutube())
                        <span class="inline-flex items-center justify-center mx-0 size-12 rounded-full bg-red-500">
                            <x-heroicon-o-video-camera class="inline size-6 stroke-white fill-white" />
                        </span>
                    @elseif ($material->isPodcast())
                        <span class="inline-flex items-center justify-center mx-0 size-12 rounded-full bg-purple-500">
                            <x-heroicon-o-microphone class="inline size-6 stroke-white" />
                        </span>
                    @endif
                </div>
            </div>
            <div>
                <div class="flex items-center gap-x-1 text-sm opacity-70 mb-2">
                    <div>
                        {{ $material->source->publisher->name }}
                    </div>
                    <div>
                        ·
                    </div>
                    <div>
                        {{ $material->published_at->inUserTimezone()->toFormattedDateString() }}
                    </div>
                </div>
                <h1 class="font-bold text-2xl lg:text-3xl">
                    {{ $material->title }}
                </h1>
                <h2 class="opacity-85 line-clamp-2">
                    {{ str($material->description)->stripTags() }}
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
            <figure>
                <img
                    src="{{ $material->isArticle() ? asset(str('storage/')->append($material->thumbnail)) : $material->thumbnail }}"
                    alt=""
                    class="rounded-box size-full shadow-2xl"
                >
            </figure>
            <div class="prose prose-img:hidden prose-figure:hidden prose-video:hidden">
                {!! $material->body !!}
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
    <div
        class="modal-backdrop"
        x-on:click="isMaterialModalOpen = false"
    ></div>
</dialog>
