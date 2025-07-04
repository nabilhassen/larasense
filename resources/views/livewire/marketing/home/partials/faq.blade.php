<section
    id="faq"
    class="container mx-auto scroll-m-20"
>
    <div class="grid sm:grid-cols-2 max-sm:space-y-12 max-sm:mx-4">
        <h2 class="font-extrabold sm:text-8xl text-6xl max-sm:text-center sm:space-y-4 opacity-65">
            <div> Frequently </div>
            <div> Asked </div>
            <div class="text-primary"> Questions </div>
        </h2>
        <aside class="space-y-6 sm:!mt-3 max-sm:mx-2">
            <div
                x-data="{ 'isActive': true }"
                x-on:click="isActive = !isActive"
                class="flex pb-3 border-b border-b-black cursor-pointer"
            >
                <div>
                    <div class="font-bold">
                        What is Larasense?
                    </div>
                    <div
                        x-cloak
                        x-show="isActive"
                        class="opacity-90"
                    >
                        Larasense is a dedicated, Laravel-focused content aggregation website. We curate content from the most trusted and credible sources
                        in the Laravel community. The ultimate goal is to keep Laravel developers updated with the latest news, and updates in an organized manner.
                    </div>
                </div>
                <div class="grow text-right">
                    <x-heroicon-o-plus
                        x-cloak
                        x-show="!isActive"
                        class="size-6 inline-block"
                    />
                    <x-heroicon-o-minus
                        x-cloak
                        x-show="isActive"
                        class="size-6 inline-block"
                    />
                </div>
            </div>
            <div
                x-data="{ 'isActive': false }"
                x-on:click="isActive = !isActive"
                class="flex pb-3 border-b border-b-black cursor-pointer"
            >
                <div>
                    <div class="font-bold">
                        Is the platform free to use?
                    </div>
                    <div
                        x-cloak
                        x-show="isActive"
                        class="opacity-90"
                    >
                        Yes. 100% free. <a
                            wire:navigate
                            class="link text-primary font-bold"
                            href="{{ route('register') }}"
                        >Sign up</a> and enjoy!
                    </div>
                </div>
                <div class="grow text-right">
                    <x-heroicon-o-plus
                        x-cloak
                        x-show="!isActive"
                        class="size-6 inline-block"
                    />
                    <x-heroicon-o-minus
                        x-cloak
                        x-show="isActive"
                        class="size-6 inline-block"
                    />
                </div>
            </div>
            <div
                x-data="{ 'isActive': false }"
                x-on:click="isActive = !isActive"
                class="flex pb-3 border-b border-b-black cursor-pointer"
            >
                <div>
                    <div class="font-bold">
                        Why focus specifically on Laravel?
                    </div>
                    <div
                        x-cloak
                        x-show="isActive"
                        class="opacity-90"
                    >
                        Just like how the Laravel framework is elegant, organized, and beautiful, the Laravel community deserves to have a home
                        where they can learn, and grow accessing high-quality content from the best in a distraction-free environment. When we say
                        Laravel-focused content we mean the whole ecosystem including PHP, Livewire, Filament, and 3rd party Laravel packages.
                    </div>
                </div>
                <div class="grow text-right">
                    <x-heroicon-o-plus
                        x-cloak
                        x-show="!isActive"
                        class="size-6 inline-block"
                    />
                    <x-heroicon-o-minus
                        x-cloak
                        x-show="isActive"
                        class="size-6 inline-block"
                    />
                </div>
            </div>
            <div
                x-data="{ 'isActive': false }"
                x-on:click="isActive = !isActive"
                class="flex pb-3 border-b border-b-black cursor-pointer"
            >
                <div>
                    <div class="font-bold">
                        Can I save or bookmark content for later?
                    </div>
                    <div
                        x-cloak
                        x-show="isActive"
                        class="opacity-90"
                    >
                        Absolutely. You can bookmark any content and access it whenever you like.
                    </div>
                </div>
                <div class="grow text-right">
                    <x-heroicon-o-plus
                        x-cloak
                        x-show="!isActive"
                        class="size-6 inline-block"
                    />
                    <x-heroicon-o-minus
                        x-cloak
                        x-show="isActive"
                        class="size-6 inline-block"
                    />
                </div>
            </div>
            <div
                x-data="{ 'isActive': false }"
                x-on:click="isActive = !isActive"
                class="flex pb-3 border-b border-b-black cursor-pointer"
            >
                <div>
                    <div class="font-bold">
                        How often is the content updated?
                    </div>
                    <div
                        x-cloak
                        x-show="isActive"
                        class="opacity-90"
                    >
                        The moment new content is out, it will be available on Larasense immediately.
                    </div>
                </div>
                <div class="grow text-right">
                    <x-heroicon-o-plus
                        x-cloak
                        x-show="!isActive"
                        class="size-6 inline-block"
                    />
                    <x-heroicon-o-minus
                        x-cloak
                        x-show="isActive"
                        class="size-6 inline-block"
                    />
                </div>
            </div>
            <div
                x-data="{ 'isActive': false }"
                x-on:click="isActive = !isActive"
                class="flex pb-3 border-b border-b-black cursor-pointer"
            >
                <div>
                    <div class="font-bold">
                        Can I search for specific topics or articles?
                    </div>
                    <div
                        x-cloak
                        x-show="isActive"
                        class="opacity-90"
                    >
                        Yes. You can search for any topic and you will get relevant results from sources in multiple formats;
                        Blog posts, YouTube videos, and Podcast episodes.
                    </div>
                </div>
                <div class="grow text-right">
                    <x-heroicon-o-plus
                        x-cloak
                        x-show="!isActive"
                        class="size-6 inline-block"
                    />
                    <x-heroicon-o-minus
                        x-cloak
                        x-show="isActive"
                        class="size-6 inline-block"
                    />
                </div>
            </div>
            <div
                x-data="{ 'isActive': false }"
                x-on:click="isActive = !isActive"
                class="flex pb-3 border-b border-b-black cursor-pointer"
            >
                <div>
                    <div class="font-bold">
                        Who can I contact for further questions, support, bug reports, etc?
                    </div>
                    <div
                        x-cloak
                        x-show="isActive"
                        class="opacity-90"
                    >
                        You can contact me on X (formerly twitter) <a
                            class="text-primary font-bold"
                            href="https://x.com/nabilhassen08"
                            target="_blank"
                        >@nabilhassen08</a> or <a
                            class="link text-primary font-bold"
                            href="mailto:nabil@larasense.com"
                        >email me</a>.
                    </div>
                </div>
                <div class="grow text-right">
                    <x-heroicon-o-plus
                        x-cloak
                        x-show="!isActive"
                        class="size-6 inline-block"
                    />
                    <x-heroicon-o-minus
                        x-cloak
                        x-show="isActive"
                        class="size-6 inline-block"
                    />
                </div>
            </div>
        </aside>
    </div>
</section>
