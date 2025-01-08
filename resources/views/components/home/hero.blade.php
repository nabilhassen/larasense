<section class="container mx-auto">
    <div class="hero py-20">
        <div class="hero-content text-center">
            <div class="space-y-8">
                <div
                    class="max-w-3xl mx-auto flex justify-center gap-x-4 max-sm:hidden"
                    x-init="change"
                    x-data="{
                        'types': ['podcast', 'youtube', 'article'],
                        'currentTypeIndex': 0,
                        change() {
                            setInterval(() => {
                                this.currentTypeIndex >= 2 ? this.currentTypeIndex = 0 : this.currentTypeIndex++;
                            }, 2000);
                        }
                    }"
                >
                    <div class="flex items-center gap-x-1 rounded-btn w-fit py-2 px-3 border border-primary text-primary text-xs font-semibold">
                        <x-heroicon-s-microphone
                            class="size-4"
                            x-bind:class="{ 'animate-pulse': types[currentTypeIndex] === 'podcast' }"
                        />
                        <span>
                            Listen Podcasts
                        </span>
                    </div>
                    <div class="flex items-center gap-x-1 rounded-btn w-fit py-2 px-3 border border-primary text-primary text-xs font-semibold">
                        <x-heroicon-s-video-camera
                            class="size-4"
                            x-bind:class="{ 'animate-pulse': types[currentTypeIndex] === 'youtube' }"
                        />
                        <span>
                            Watch YouTube
                        </span>
                    </div>
                    <div class="flex items-center gap-x-1 rounded-btn w-fit py-2 px-3 border border-primary text-primary text-xs font-semibold">
                        <x-heroicon-s-pencil-square
                            class="size-4"
                            x-bind:class="{ 'animate-pulse': types[currentTypeIndex] === 'article' }"
                        />
                        <span>
                            Read Articles
                        </span>
                    </div>
                </div>
                <h1 class="max-w-4xl sm:text-6xl text-5xl font-bold !mt-4 dark:text-primary">
                    Stay informed. Stay ahead. Laravel news all in one place.
                </h1>
                <p class="max-w-3xl mx-auto">
                    Stay on top of the latest news, updates, and trends in the Laravel ecosystem with our curated content
                    from your favorite and most trusted blogs, YouTube channels, and podcasts, all presented in a simple, beautiful design.
                </p>
                <a
                    wire:navigate
                    class="btn lg:btn-lg bg-primary font-bold text-white border-none hover:bg-primary hover:brightness-90"
                    href="{{ route('register') }}"
                >
                    Falling behind? Join now, it's free
                    <x-heroicon-o-arrow-long-right class="inline size-8" />
                </a>
            </div>
        </div>
    </div>
    <div class="mockup-window overflow-hidden max-sm:ml-4 shadow-2xl shadow-primary/30 bg-white dark:bg-stone-900 border border-stone-100 dark:border-none max-sm:rounded-none max-sm:rounded-tl-box sm:max-w-6xl sm:mx-auto">
        <figure class="border-t border-stone-100 dark:border-none">
            <img
                loading="lazy"
                src="{{ asset('/img/light_screenshot.png') }}"
                alt="Dashboard"
                class="max-sm:max-w-4xl dark:hidden"
            >

            <img
                loading="lazy"
                src="{{ asset('/img/dark_screenshot.png') }}"
                alt="Dashboard"
                class="max-sm:max-w-4xl hidden dark:block"
            >
        </figure>
    </div>
</section>
