@props(['material'])

<div
    wire:ignore
    x-cloak
    x-data="podcastPlayer"
    x-on:close-podcast-modal.window="continueOnMainPodcastPlayer($event.detail)"
    class="rounded-btn bg-accent dark:bg-stone-900 p-2 lg:p-4 border-2 border-secondary"
>
    <div class="flex gap-x-2 text-xs lg:text-sm">
        <figure class="w-1/5 hidden lg:block">
            <img
                loading="lazy"
                src="{{ $material->thumbnail }}"
                class="rounded-box size-full"
            >
        </figure>
        <div class="flex flex-col justify-between max-lg:gap-y-2 w-full">
            <div class="flex gap-x-2 pl-[5.6px]">
                <figure class="lg:hidden">
                    <img
                        loading="lazy"
                        src="{{ $material->thumbnail }}"
                        class="rounded max-h-14"
                    >
                </figure>
                <div>
                    <div class="font-bold line-clamp-1">
                        {{ $material->source->publisher->name }}
                    </div>
                    <div class="line-clamp-1">
                        {!! $material->title !!}
                    </div>
                    <div class="flex gap-x-1 line-clamp-1">
                        <div>
                            {{ $material->published_at->inUserTimezone()->toFormattedDateString() }}
                        </div>
                        <div>
                            ·
                        </div>
                        <div>
                            {{ Carbon\CarbonInterval::seconds($material->duration)->cascade()->forHumans(['short' => true]) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="podcast-player">
                <audio
                    class="player"
                    controls
                    x-on:play.once="$wire.played('{{ $material->slug }}')"
                >
                    <source src="{{ $material->url }}" />
                </audio>
            </div>
        </div>
    </div>
</div>
