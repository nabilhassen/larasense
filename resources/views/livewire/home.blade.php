<div class="space-y-20">
    <div class="bg-gradient-to-b from-[#FFF1DB] pt-4">
        <div class="container mx-auto">
            <x-navbar />
            <x-hero />
            <figure class="ml-4 sm:mx-0 overflow-hidden">
                <img
                    src="{{ asset('/img/dashboard.png') }}"
                    class="sm:rounded-badge rounded-tl-badge max-w-2xl sm:max-w-full"
                    alt="Dashboard"
                >
            </figure>
        </div>
    </div>
    <x-sources />
    <x-benefits />
    <x-comparison />
</div>
