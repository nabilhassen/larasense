@props(['material'])

<div
    wire:ignore
    x-cloak
    x-data="podcastPlayer"
    x-on:close-podcast-modal.window="continueOnMainPodcastPlayer($event.detail)"
    class="flex items-center bg-secondary rounded-btn p-4"
>
    <figure class="w-1/5">
        <img
            src="{{ $material->thumbnail }}"
            alt=""
            class="rounded-box size-full"
        >
    </figure>
    <div class="podcast-player w-full">
        <audio
            class="player"
            controls
            x-on:play="$wire.played('{{ $material->slug }}')"
        >
            <source
                src="{{ $material->url }}"
                type="audio/mp3"
            />
        </audio>
    </div>
</div>
