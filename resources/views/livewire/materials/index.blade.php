<div class="max-lg:pb-16 max-lg:pt-8">
    <div class="grid xl:grid-cols-3 lg:grid-cols-2 grid-cols-1 lg:gap-x-4 gap-y-8">
        @foreach ($materials as $material)
            <livewire:materials.show
                :$material
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
