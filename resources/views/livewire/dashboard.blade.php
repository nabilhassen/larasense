<div class="grid xl:grid-cols-3 lg:grid-cols-2 grid-cols-1 lg:gap-x-4 gap-y-8 pb-24 max-lg:pt-8">
    @foreach ($materials as $material)
        <livewire:materials.show
            :slug="$material->slug"
            :key="$material->slug"
        />
    @endforeach

    <div x-intersect.margin.412px="$wire.loadMore()">
    </div>
</div>
