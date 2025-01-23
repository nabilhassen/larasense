<div>
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
    />
</div>
