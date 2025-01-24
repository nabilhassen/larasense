<div>
    <div class="lg:w-8/12">
        <a
            x-on:click.prevent="history.back()"
            class="inline-flex items-center gap-x-2 cursor-pointer"
        >
            <x-heroicon-o-arrow-left class="inline size-6 stroke-primary" />
            <span>
                Back
            </span>
        </a>
        @include('livewire.materials.partials.detail')
    </div>
</div>
