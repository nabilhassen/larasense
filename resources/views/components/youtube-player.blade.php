@props(['material'])

<div
    wire:ignore
    x-bind:class="{ 'overflow-hidden rounded-btn aspect-video cursor-pointer': true }"
    x-data="youtubePlayer"
    x-on:close-youtube-modal.window="player.pause()"
    x-init="$nextTick(() => { player.once('play', () => $wire.played('{{ $material->slug }}')) })"
>
    <iframe
        class="size-full"
        loading="lazy"
        src="{{ $material->urlForEmbed }}"
        title="{!! $material->title !!}"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen
        allowtransparency
    ></iframe>
</div>
