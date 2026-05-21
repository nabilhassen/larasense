@props(['paginator', 'perPage'])

<div class="py-8">
    @if ($paginator->hasMorePages() && $perPage < 100)
        <div
            x-intersect.margin.75%="$wire.loadMore()"
            class="flex justify-center"
        >
            <div
                wire:loading
                wire:target="loadMore"
            >
                <x-heroicon-o-arrow-path class="size-6 animate-spin stroke-primary" />
            </div>
        </div>
    @else
        <div class="flex justify-center bg-accent dark:bg-stone-900 py-4 px-8 rounded-box w-fit mx-auto text-primary font-bold">
            No {{ $paginator->count() ? 'more' : '' }} content available.
        </div>
    @endif
</div>
