<section class="border-2 border-accent rounded p-4 space-y-8">
    <h2 class="sm:text-xl text-sm flex justify-between items-center gap-x-2">
        <span class="inline text-primary sm:size-8 size-6">
            @svg($icon)
        </span>
        <span class="opacity-90 text-primary">
            {{ $title }}
        </span>
    </h2>
    <div class="space-y-6">
        @foreach ($materials as $material)
            <div class="relative flex max-sm:flex-col max-sm:gap-y-2 w-full gap-x-4">
                <a
                    class="absolute size-full inset-0"
                    href="{{ route('materials.show', $material->slug) }}"
                    target="_blank"
                ></a>
                <figure>
                    <img
                        src="{{ asset($material->thumbnail) }}"
                        class="rounded sm:w-36 sm:h-24 w-full h-36 object-cover"
                    >
                </figure>
                <div class="sm:w-9/12 flex flex-col">
                    <div
                        class="font-bold line-clamp-2 text-sm"
                        title="{!! $material->title !!}"
                    >
                        {!! $material->title !!}
                    </div>
                    <div class="flex items-center gap-x-1 opacity-70 text-sm">
                        <div>
                            {{ str($material->source->type->value)->title() }} by
                        </div>
                        <div class="avatar">
                            <div class="w-6 rounded-full">
                                <img src="{{ asset('storage/' . $material->source->publisher->logo) }}" />
                            </div>
                        </div>
                        <div>
                            {{ $material->source->publisher->name }}
                        </div>
                    </div>
                    <div class="grow flex items-end max-sm:mt-4">
                        <a
                            class="link link-primary text-sm"
                            target="_blank"
                            href="{{ route('materials.show', $material->slug) }}"
                        >Read more</a>
                    </div>
                </div>
            </div>
            @if (!$loop->last)
                <hr>
            @endif
        @endforeach
    </div>
</section>
