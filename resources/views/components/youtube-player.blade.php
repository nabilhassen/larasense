@props(['material'])

<div
    wire:ignore
    x-bind:class="{ 'overflow-hidden rounded-btn aspect-video': true }"
    x-data="youtubePlayer"
    x-on:close-youtube-modal.window="player.pause()"
>
    <iframe
        class="size-full"
        src="https://www.youtube.com/embed/{{ str($material->url)->afterLast('?v=') }}?mute=0"
        title="{{ $material->title }}"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen
        allowtransparency
    ></iframe>
</div>
