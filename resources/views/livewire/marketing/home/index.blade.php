<div class="space-y-20">
    <div class="bg-gradient-to-b from-secondary dark:from-stone-900 to-65%">
        <x-navbar />
        @include('livewire.marketing.home.partials.hero')
    </div>
    @include('livewire.marketing.home.partials.sources')
    @include('livewire.marketing.home.partials.benefits')
    @include('livewire.marketing.home.partials.comparison')
    @include('livewire.marketing.home.partials.faq')
    @include('livewire.marketing.home.partials.cta')
    <x-footer />
</div>
