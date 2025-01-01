<div x-data="{
    'isAutoCompleteVisible': true,
    'currentMaterialIndex': 0,
    'currentSlug': null,
}">
    <label class="relative input input-bordered flex items-center gap-2 bg-stone-50 dark:bg-stone-900 border border-stone-50 dark:border-stone-900 focus:border focus-within:border !outline-none">
        <input
            type="text"
            class="grow"
            placeholder="Search"
            wire:model.live="query"
            x-on:click="isAutoCompleteVisible = true"
            x-on:click.outside="isAutoCompleteVisible = false;currentMaterialIndex = 0"
            x-on:keyup.enter="$wire.view(currentSlug);isAutoCompleteVisible = false;$el.blur();"
            x-on:keyup.escape="isAutoCompleteVisible = false;currentMaterialIndex = 0;$el.blur()"
            x-on:keydown.up="isAutoCompleteVisible = true;currentMaterialIndex == 0 ? currentMaterialIndex = @js($materials->count() - 1) : currentMaterialIndex--"
            x-on:keydown.down="isAutoCompleteVisible = true;currentMaterialIndex == @js($materials->count() - 1) ? currentMaterialIndex = 0 : currentMaterialIndex++"
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
        @if (filled($query))
            <div
                class="absolute inset-x-0 z-10 top-full max-h-fit overflow-y-auto mt-2 rounded-btn bg-stone-50 dark:bg-stone-900 border border-stone-200 dark:border-stone-900"
                x-bind:class="{ 'hidden': !isAutoCompleteVisible }"
            >
                @forelse ($materials as $materialItem)
                    <div
                        class="flex gap-x-4 items-center p-3 lg:text-sm text-xs cursor-pointer border-b border-b-stone-200 dark:border-b-stone-950 hover:bg-stone-100 dark:hover:bg-stone-950"
                        wire:click="view('{{ $materialItem->slug }}')"
                        x-bind:class="{ 'bg-stone-100 dark:bg-stone-950': currentMaterialIndex == @js($loop->index) }"
                        x-effect="currentMaterialIndex === @js($loop->index) && (currentSlug = @js($materialItem->slug))"
                    >
                        <figure class="flex max-lg:hidden w-2/12">
                            <img
                                src="{{ $materialItem->thumbnail }}"
                                class="h-10 w-full object-cover rounded"
                            >
                        </figure>
                        <div class="w-full">
                            <div
                                class="font-bold line-clamp-1"
                                title="{!! $materialItem->title !!}"
                            >
                                {!! $materialItem->title !!}
                            </div>
                            <div class="flex items-center gap-x-1 opacity-70">
                                <div>
                                    {{ $materialItem->source->publisher->name }}
                                </div>
                                <div class="max-lg:hidden">
                                    ·
                                </div>
                                <div class="max-lg:hidden">
                                    {{ str($materialItem->source->type->value)->title() }}
                                </div>
                                <div class="max-lg:hidden">
                                    ·
                                </div>
                                <div class="max-lg:hidden">
                                    {{ $materialItem->published_at->inUserTimezone()->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex gap-x-4 items-center p-3 lg:text-sm text-xs cursor-pointer border-b border-b-stone-200">
                        No results found. Try another search query.
                    </div>
                @endforelse
            </div>
        @endif
    </label>

    @if (filled($material))
        <dialog
            class="modal lg:modal-top cursor-auto"
            x-data
            x-init="$el.showModal()"
            x-on:close="() => {
                $dispatch('close-{{ $material->source->type }}-modal', { material: @js($material) });
                $el.remove();
            }"
        >
            <div class="modal-box lg:max-w-6xl lg:mx-auto lg:h-full dark:bg-black">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
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
                            {!! $material->title !!}
                        </h1>
                        <h2 class="opacity-85 line-clamp-2">
                            {{ str($material->description)->stripTags() }}
                        </h2>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex gap-x-6">
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
                                        'stroke-stone-800 dark:stroke-stone-600': !isLiked
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
                                        'stroke-stone-800 dark:stroke-stone-600': !isDisliked
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
                                        'stroke-stone-800 dark:stroke-stone-600': !isBookmarked
                                    }"
                                />
                            </button>
                            <div
                                class="tooltip"
                                x-bind:class="{ 'tooltip-open': isCopied }"
                                x-bind:data-tip="isCopied ? 'Link Copied!' : 'Copy Link'"
                                x-data="copyLink('{{ $material->url }}')"
                            >
                                <button
                                    class="inline-flex"
                                    x-on:click="copy"
                                >
                                    <x-heroicon-o-link
                                        class="inline-flex lg:size-8 size-6 hover:stroke-primary"
                                        x-bind:class="{
                                            'stroke-primary': isCopied,
                                            'stroke-stone-800 dark:stroke-stone-600': !isCopied
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
