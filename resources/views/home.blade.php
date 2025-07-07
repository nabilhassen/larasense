<x-layouts.guest>
    <x-slot:title>Your Hub for Laravel News, Trends & Updates</x-slot>
    <div class="space-y-20">
        <div class="bg-gradient-to-b from-secondary dark:from-stone-900 to-65%">
            <x-navbar />
            <x-sections.hero />
        </div>
        <x-sections.sources />
        <x-sections.benefits />
        <x-sections.comparison />
        <x-sections.faq />
        <x-sections.cta />
        <x-footer />
    </div>
</x-layouts.guest>
