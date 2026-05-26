<div
    x-cloak
    x-data="mainPodcastPlayer"
    x-show="isSourceSet"
    class="w-full lg:w-2/3 rounded-box bg-accent dark:bg-stone-900 space-y-2 px-2 border-2 border-secondary"
>
    <div class="flex items-start gap-x-2 text-xs pt-2.5 pl-[5.6px]">
        <figure class="shrink-0">
            <img
                loading="lazy"
                x-bind:src="thumbnail"
                class="rounded-sm max-h-12"
            >
        </figure>
        <div class="min-w-0 flex-1">
            <div
                class="font-bold line-clamp-1"
                x-text="publisherName"
            >
            </div>
            <div
                class="line-clamp-1"
                x-html="materialTitle"
            >
            </div>
            <div class="flex gap-x-1 line-clamp-1">
                <div x-text="publishedAt"></div>
                <div>·</div>
                <div x-text="duration"></div>
            </div>
        </div>
        <button
            class="btn btn-link text-inherit hover:text-primary btn-xs sm:btn-sm shrink-0 hover:bg-none"
            x-on:click="close()"
        >
            <x-heroicon-o-x-mark class="size-4 sm:size-5" />
        </button>
    </div>
    <div id="main-podcast-player-container">
        <audio
            id="main-podcast-player"
            controls
        >
        </audio>
    </div>
</div>
