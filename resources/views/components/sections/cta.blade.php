<section class="container mx-auto">
    <div class="bg-accent dark:bg-stone-900 rounded-badge p-12 max-sm:px-8 space-y-10 max-sm:mx-4">
        <div>
            <h2 class="sm:text-4xl text-3xl font-bold">
                Get Your Laravel Updates On Time<span class="sm:text-5xl text-3xl">.</span>
            </h2>
            <h3 class="sm:mt-2 mt-4">
                Curated content, beautifully presented from the best content creators in the Laravel community.
            </h3>
        </div>
        <a
            wire:navigate
            class="btn bg-primary font-bold text-white border-none hover:bg-primary hover:brightness-90"
            href="{{ route('register') }}"
        >
            Join now, it's free
            <x-heroicon-o-arrow-long-right class="inline size-8" />
        </a>
    </div>
</section>
