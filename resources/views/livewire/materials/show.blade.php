<div>
    <div class="lg:w-8/12">
        <div class="breadcrumbs text-sm mb-4 pt-0">
            <ul>
                <li>
                    <a
                        href="{{ route('materials.index') }}"
                        wire:navigate
                    >
                        Home
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('materials.show', $material->slug) }}"
                        wire:navigate
                        @class([
                            'text-primary' => request()->routeIs(['materials.show']),
                        ])
                    >
                        {!! $material->title !!}
                    </a>
                </li>
            </ul>
        </div>

        @include('livewire.materials.partials.detail')
    </div>
</div>
