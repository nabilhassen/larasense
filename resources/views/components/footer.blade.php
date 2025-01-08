<footer class="container mx-auto">
    <div class="py-8 max-sm:mx-4">
        <div class="flex max-sm:flex-col justify-between sm:items-center">
            <figure>
                <img
                    class="w-52"
                    src="{{ asset('img/logo.png') }}"
                    alt="Larasense logo"
                >
            </figure>
            <ul class="menu menu-vertical sm:menu-horizontal">
                <li>
                    <a
                        class="hover:bg-secondary dark:hover:bg-stone-900 active:!bg-secondary dark:active:!bg-stone-900 focus:!bg-secondary dark:focus:!bg-stone-900 active:!text-inherit max-sm:pl-0"
                        href="{{ route('home') }}"
                        wire:navigate
                    >
                        Home
                    </a>
                </li>
                <li>
                    <a
                        class="hover:bg-secondary dark:hover:bg-stone-900 active:!bg-secondary dark:active:!bg-stone-900 focus:!bg-secondary dark:focus:!bg-stone-900 active:!text-inherit max-sm:pl-0"
                        href="{{ route('home') }}#sources"
                    >
                        Sources
                    </a>
                </li>
                <li>
                    <a
                        class="hover:bg-secondary dark:hover:bg-stone-900 active:!bg-secondary dark:active:!bg-stone-900 focus:!bg-secondary dark:focus:!bg-stone-900 active:!text-inherit max-sm:pl-0"
                        href="{{ route('home') }}#benefits"
                    >
                        Benefits
                    </a>
                </li>
                <li>
                    <a
                        class="hover:bg-secondary dark:hover:bg-stone-900 active:!bg-secondary dark:active:!bg-stone-900 focus:!bg-secondary dark:focus:!bg-stone-900 active:!text-inherit max-sm:pl-0"
                        href="{{ route('home') }}#faq"
                    >
                        FAQ
                    </a>
                </li>
                <li>
                    <a
                        wire:navigate
                        class="hover:bg-secondary dark:hover:bg-stone-900 active:!bg-secondary dark:active:!bg-stone-900 focus:!bg-secondary dark:focus:!bg-stone-900 active:!text-inherit max-sm:pl-0"
                        href="{{ route('login') }}"
                    >
                        Login
                    </a>
                </li>
                <li>
                    <a
                        wire:navigate
                        class="hover:bg-secondary dark:hover:bg-stone-900 active:!bg-secondary dark:active:!bg-stone-900 focus:!bg-secondary dark:focus:!bg-stone-900 active:!text-inherit max-sm:pl-0"
                        href="{{ route('register') }}"
                    >
                        Sign up
                    </a>
                </li>
            </ul>
            <div class="font-bold max-sm:text-center max-sm:my-4">
                support@larasense.com
            </div>
        </div>
        <hr class="mt-8 mb-4 bg-stone-100">
        <div class="flex max-sm:flex-col max-sm:space-y-4 justify-between text-sm">
            <p>
                Built with <x-heroicon-o-heart class="size-6 inline-block stroke-primary" /> by <a
                    class="underline font-bold"
                    href="https://x.com/nabilhassen08"
                    target="_blank"
                >Nabil Hassen</a>
            </p>
            <div>
                <ul class="flex space-x-4">
                    <li>
                        <a
                            class="link link-hover"
                            href="{{ route('terms') }}"
                        >
                            Terms & Conditions
                        </a>
                    </li>
                    <li>
                        <a
                            class="link link-hover"
                            href="{{ route('privacy') }}"
                        >
                            Privacy Policy
                        </a>
                    </li>
                </ul>
                <p class="mt-1">
                    Copyright © {{ date('Y') }} Larasense. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
