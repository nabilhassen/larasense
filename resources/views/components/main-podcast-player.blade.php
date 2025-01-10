<div
    x-cloak
    x-data="mainPodcastPlayer"
    x-show="isSourceSet"
    class="lg:w-2/3 rounded-btn bg-accent dark:bg-stone-900 space-y-2 px-2 border-2 border-secondary"
>
    <div class="flex gap-x-2 text-xs pt-2 pl-[5.6px]">
        <figure>
            <img
                loading="lazy"
                x-bind:src="thumbnail"
                class="rounded max-h-12"
            >
        </figure>
        <div>
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
    </div>
    <div id="main-podcast-player-container">
        <audio
            id="main-podcast-player"
            controls
        >
        </audio>
    </div>
</div>
