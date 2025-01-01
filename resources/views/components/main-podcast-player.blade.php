<div
    x-cloak
    x-data="mainPodcastPlayer"
    x-show="isSourceSet"
    x-on:play-podcast.window="play($event.detail)"
    x-on:pause-podcast.window="player.pause()"
    class="lg:w-6/12 h-16 flex items-center p-4 rounded-btn bg-secondary dark:bg-stone-900"
>
    <figure>
        <img
            x-bind:src="thumbnail"
            alt=""
            class="rounded max-h-12"
        >
    </figure>
    <div id="main-podcast-player-container">
        <audio
            id="main-podcast-player"
            controls
        >
        </audio>
    </div>
</div>
