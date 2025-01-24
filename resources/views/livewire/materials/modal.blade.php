<div>
    @if (filled($material))
        <dialog
            wire:ignore
            class="modal lg:modal-top cursor-auto"
            x-data
            x-init="() => {
                $el.showModal();
                $wire.expanded();
            }"
            x-on:close="() => {
                $dispatch('close-{{ $material->source->type }}-modal', { 
                    url: '{{ $material->url }}',
                    thumbnail: '{{ $material->thumbnail }}',
                    publisherName: '{{ $material->source->publisher->name }}',
                    materialTitle: @js($material->title),
                    publishedAt: '{{ $material->published_at->inUserTimezone()->toFormattedDateString() }}',
                    duration: '{{ Carbon\CarbonInterval::seconds($material->duration)->cascade()->forHumans(['short' => true]) }}',
                });
                
                $el.remove();
            }"
        >
            <div class="modal-box lg:max-w-6xl lg:mx-auto lg:h-full dark:bg-black dark:border-2 dark:border-stone-800">
                <button autofocus></button>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <div class="lg:w-8/12 mx-auto">
                    @include('livewire.materials.partials.detail')
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
