<div x-data="{
    'isAutoCompleteVisible': true,
    'currentMaterialIndex': 0,
    'currentSlug': null,
}">
    <label class="relative input input-bordered flex items-center gap-2 bg-stone-50 dark:bg-stone-900 border-stone-50 dark:border-stone-900 focus-within:border-stone-200 dark:focus-within:border-stone-800 !outline-none">
        <input
            type="text"
            class="grow"
            placeholder="Search"
            wire:model.live.debounce.500ms="query"
            x-on:click="isAutoCompleteVisible = true"
            x-on:click.outside="isAutoCompleteVisible = false;currentMaterialIndex = 0;"
            x-on:keyup.enter="() => {
                if (!$el.value.trim()) return;

                $dispatch('open-material-modal', {
                    slug: currentSlug
                });

                isAutoCompleteVisible = false;
                $el.blur();
            }"
            x-on:keyup.escape="isAutoCompleteVisible = false;currentMaterialIndex = 0;$el.blur()"
            x-on:keydown.up="isAutoCompleteVisible = true;currentMaterialIndex == 0 ? (currentMaterialIndex = @js($materials->count() - 1)) : currentMaterialIndex--"
            x-on:keydown.down="isAutoCompleteVisible = true;currentMaterialIndex == @js($materials->count() - 1) ? currentMaterialIndex = 0 : currentMaterialIndex++"
        />
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16"
            fill="currentColor"
            class="h-4 w-4 opacity-70"
        >
            <path
                fill-rule="evenodd"
                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                clip-rule="evenodd"
            />
        </svg>
        @if (filled($query))
            <div
                class="absolute inset-x-0 z-10 top-full max-h-fit overflow-y-auto mt-2 rounded-btn bg-stone-50 dark:bg-stone-900 border border-stone-200 dark:border-stone-800"
                x-bind:class="{ 'hidden': !isAutoCompleteVisible }"
            >
                @forelse ($materials as $materialItem)
                    <div
                        class="flex gap-x-4 items-center p-3 lg:text-sm text-xs cursor-pointer border-b border-b-stone-200 dark:border-b-stone-950 hover:bg-stone-100 dark:hover:bg-stone-950"
                        x-on:click.prevent="() => {
                            $dispatch('open-material-modal', {
                                slug: '{{ $materialItem->slug }}'
                            });
                        }"
                        x-bind:class="{ 'bg-stone-100 dark:bg-stone-950': currentMaterialIndex == @js($loop->index) }"
                        x-effect="currentMaterialIndex === @js($loop->index) && (currentSlug = @js($materialItem->slug))"
                    >
                        <figure class="flex max-lg:hidden w-2/12">
                            <img
                                loading="lazy"
                                src="{{ $materialItem->thumbnail }}"
                                class="h-10 w-full object-cover rounded"
                            >
                        </figure>
                        <div class="w-full">
                            <div
                                class="font-bold line-clamp-1"
                                title="{!! $materialItem->title !!}"
                            >
                                {!! $materialItem->title !!}
                            </div>
                            <div class="flex items-center gap-x-1 opacity-70">
                                <div>
                                    {{ $materialItem->source->publisher->name }}
                                </div>
                                <div class="max-lg:hidden">
                                    ·
                                </div>
                                <div class="max-lg:hidden">
                                    {{ str($materialItem->source->type->value)->title() }}
                                </div>
                                <div class="max-lg:hidden">
                                    ·
                                </div>
                                <div class="max-lg:hidden">
                                    {{ $materialItem->published_at->inUserTimezone()->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex gap-x-4 items-center p-3 lg:text-sm text-xs cursor-pointer">
                        No results found. Try another search query.
                    </div>
                @endforelse
            </div>
        @endif
    </label>
</div>
