<div>
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
                    href="{{ route('publishers.show', $publisher->slug) }}"
                    wire:navigate
                    @class([
                        'text-primary' => request()->routeIs(['publishers.show']),
                    ])
                >
                    {{ $publisher->name }}
                </a>
            </li>
        </ul>
    </div>

    <div class="grid xl:grid-cols-3 lg:grid-cols-2 grid-cols-1 lg:gap-x-4 gap-y-8">
        @foreach ($materials as $material)
            <livewire:materials.card
                :slug="$material->slug"
                wire:key="material-{{ $material->slug }}"
            />
        @endforeach
    </div>

    <x-load-more
        :paginator="$materials"
        :$perPage
        message="No more content available."
    />
</div>
