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
        src="https://www.youtube.com/embed/{{ str($material->url)->afterLast('?v=') }}?autoplay=0&controls=0&disablekb=1&playsinline=1&cc_load_policy=1&cc_lang_pref=auto&widget_referrer=https%3A%2F%2Fplyr.io%2F%23youtube&rel=0&showinfo=0&iv_load_policy=3&modestbranding=1&customControls=true&noCookie=false&enablejsapi=1&origin=https%3A%2F%2Fplyr.io&widgetid=1"
        title="{!! $material->title !!}"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen
        allowtransparency
    ></iframe>
</div>
