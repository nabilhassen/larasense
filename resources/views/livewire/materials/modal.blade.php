<div>
    @if (filled($material))
        <dialog
            wire:ignore
            class="modal lg:modal-top cursor-auto"
            x-data
            x-init="() => {
                $el.showModal();
                $wire.expanded();
            }"
            x-on:close="() => {
                $dispatch('close-{{ $material->source->type }}-modal', { 
                    material: @js($material),
                    publishedAt: '{{ $material->published_at->inUserTimezone()->toFormattedDateString() }}',
                    duration: '{{ Carbon\CarbonInterval::seconds($material->duration)->cascade()->forHumans(['short' => true]) }}',
                });
                
                $el.remove();
            }"
        >
            <div class="modal-box lg:max-w-6xl lg:mx-auto lg:h-full dark:bg-black dark:border-2 dark:border-stone-800">
                <button autofocus></button>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <div class="lg:w-8/12 mx-auto space-y-8">
                    <div class="flex justify-between items-center">
                        <div class="avatar">
                            <div class="w-12 rounded-full">
                                <img
                                    loading="lazy"
                                    src="{{ asset('storage/' . $material->source->publisher->logo) }}"
                                />
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
                        <div class="flex max-sm:flex-col sm:items-center gap-x-1 text-sm opacity-70 mb-2">
                            <div>
                                {{ $material->source->publisher->name }}
                            </div>
                            <div class="max-sm:hidden">
                                ·
                            </div>
                            <div class="max-sm:opacity-60">
                                {{ $material->published_at->inUserTimezone()->toFormattedDateString() }}
                            </div>
                            @if (filled($material->duration))
                                <div class="max-sm:hidden">
                                    ·
                                </div>
                                <div class="max-sm:hidden">
                                    {{ Carbon\CarbonInterval::seconds($material->duration)->cascade()->forHumans(['short' => true]) }}
                                </div>
                            @endif
                        </div>
                        <h1 class="font-bold text-2xl lg:text-3xl">
                            {!! $material->title !!}
                        </h1>
                        <h2 class="opacity-85 line-clamp-2">
                            {!! str($material->description)->stripTags() !!}
                        </h2>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-x-2 lg:gap-x-6">
                            <button
                                class="inline-flex items-center gap-x-1"
                                x-data="likeMaterial(
                                    '{{ $material->slug }}',
                                    @js($this->isLiked),
                                    {{ $this->likesCount }}
                                )"
                                x-on:click="toggleLike"
                            >
                                <x-heroicon-o-hand-thumb-up
                                    x-cloak
                                    class="inline-flex lg:size-8 size-6 hover:stroke-primary"
                                    x-bind:class="{
                                        'stroke-primary fill-primary': isLiked,
                                        'stroke-stone-800 dark:stroke-stone-300': !isLiked
                                    }"
                                />
                                <span
                                    class="opacity-70"
                                    x-text="likesCount > 0 ? likesCount : null"
                                >
                                </span>
                            </button>
                            <button
                                class="inline-flex"
                                x-data="dislikeMaterial('{{ $material->slug }}', {{ $this->isDisliked }})"
                                x-on:click="toggleDislike"
                            >
                                <x-heroicon-o-hand-thumb-down
                                    x-cloak
                                    class="inline-flex lg:size-8 size-6 hover:stroke-primary"
                                    x-bind:class="{
                                        'stroke-primary fill-primary': isDisliked,
                                        'stroke-stone-800 dark:stroke-stone-300': !isDisliked
                                    }"
                                />
                            </button>
                            <button
                                class="inline-flex"
                                x-data="bookmarkMaterial(
                                    '{{ $material->slug }}',
                                    {{ $this->isBookmarked }}
                                )"
                                x-on:click="toggleBookmark"
                            >
                                <x-heroicon-o-bookmark
                                    x-cloak
                                    class="inline-flex lg:size-8 size-6 hover:stroke-primary"
                                    x-bind:class="{
                                        'stroke-primary fill-primary': isBookmarked,
                                        'stroke-stone-800 dark:stroke-stone-300': !isBookmarked
                                    }"
                                />
                            </button>
                            <div
                                class="relative lg:tooltip"
                                x-bind:class="{ 'lg:tooltip-open': isCopied }"
                                x-bind:data-tip="isCopied && 'Link Copied!'"
                                x-data="copyLink('{{ $material->url }}')"
                            >
                                <button
                                    class="flex items-center"
                                    x-on:click="copy"
                                >
                                    <x-heroicon-o-link
                                        class="inline-flex lg:size-8 size-6 hover:stroke-primary"
                                        x-bind:class="{
                                            'stroke-primary': isCopied,
                                            'stroke-stone-800 dark:stroke-stone-300': !isCopied
                                        }"
                                    />
                                </button>
                            </div>
                        </div>
                        @if ($material->isArticle())
                            <div>
                                <a
                                    class="btn max-lg:btn-sm max-lg:text-xs btn-primary btn-outline hover:!text-white"
                                    href="{{ $material->url }}"
                                    target="_blank"
                                    x-on:click="$wire.redirected('{{ $material->slug }}')"
                                >
                                    <x-heroicon-o-arrow-top-right-on-square class="lg:size-6 size-4" />
                                    <span>
                                        Read Post
                                    </span>
                                </a>
                            </div>
                        @endif
                    </div>
                    @if ($material->isArticle())
                        <hr class="!my-12">
                        <figure>
                            <img
                                loading="lazy"
                                src="{{ $material->thumbnail }}"
                                alt=""
                                class="rounded-box size-full shadow-2xl"
                            >
                        </figure>
                        <div class="prose prose-img:hidden prose-figure:hidden prose-video:hidden dark:text-stone-400 dark:prose-a:text-stone-500 dark:prose-headings:text-stone-300">
                            {!! $material->body !!}
                        </div>
                    @elseif ($material->isYoutube())
                        <x-youtube-player :material="$material" />
                    @elseif ($material->isPodcast())
                        <x-podcast-player :material="$material" />
                    @endif
                    <hr class="!my-12">
                </div>
            </div>
            <form
                method="dialog"
                class="modal-backdrop backdrop-blur-sm"
            >
                <button>close</button>
            </form>
        </dialog>
    @endif
</div>
