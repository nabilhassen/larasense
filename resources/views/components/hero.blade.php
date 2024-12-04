<section class="container mx-auto text-stone-700">
    <div class="hero py-20">
        <div class="hero-content text-center">
            <div class="max-w-4xl">
                <h1 class="sm:text-7xl text-5xl font-extrabold">
                    The Only Laravel News Website You'll Ever Need
                </h1>
                <p class="max-w-3xl mx-auto py-6">
                    We will help you stay on top of the latest news, updates, and trends in the Laravel ecosystem by curating content
                    from your favorite and most trusted blogs, YouTube channels, and podcasts, all presented in a simple and beautiful design.
                </p>
                <a
                    class="btn btn-lg bg-primary font-bold text-white border-none hover:bg-primary hover:brightness-90"
                    href="{{ route('register') }}"
                >
                    Falling behind? Join now, it's free
                    <x-heroicon-o-arrow-long-right class="inline size-8" />
                </a>
            </div>
        </div>
    </div>
    <figure class="max-sm:ml-4 overflow-hidden">
        <img
            src="{{ asset('/img/dashboard.png') }}"
            class="sm:rounded-badge rounded-tl-badge max-w-2xl sm:max-w-6xl sm:mx-auto"
            alt="Dashboard"
        >
    </figure>
</section>
