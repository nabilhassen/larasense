<footer class="bg-stone-50 text-stone-700">
    <div class="container mx-auto p-8 pl-4">
        <div class="flex sm:flex-row flex-col justify-between sm:items-center">
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
                        class="hover:bg-[#FFF1DB] active:!bg-[#FFF1DB] focus:!bg-[#FFF1DB] active:!text-inherit max-sm:pl-0"
                        href="{{ route('home') }}"
                        wire:navigate
                    >
                        Home
                    </a>
                </li>
                <li>
                    <a
                        class="hover:bg-[#FFF1DB] active:!bg-[#FFF1DB] focus:!bg-[#FFF1DB] active:!text-inherit max-sm:pl-0"
                        href="#sources"
                    >
                        Sources
                    </a>
                </li>
                <li>
                    <a
                        class="hover:bg-[#FFF1DB] active:!bg-[#FFF1DB] focus:!bg-[#FFF1DB] active:!text-inherit max-sm:pl-0"
                        href="#benefits"
                    >
                        Benefits
                    </a>
                </li>
                <li>
                    <a
                        class="hover:bg-[#FFF1DB] active:!bg-[#FFF1DB] focus:!bg-[#FFF1DB] active:!text-inherit max-sm:pl-0"
                        href="#faq"
                    >
                        FAQ
                    </a>
                </li>
                <li>
                    <a
                        class="hover:bg-[#FFF1DB] active:!bg-[#FFF1DB] focus:!bg-[#FFF1DB] active:!text-inherit max-sm:pl-0"
                        href="#faq"
                    >
                        Login
                    </a>
                </li>
                <li>
                    <a
                        class="hover:bg-[#FFF1DB] active:!bg-[#FFF1DB] focus:!bg-[#FFF1DB] active:!text-inherit max-sm:pl-0"
                        href="#faq"
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
                Built with <x-heroicon-o-heart class="size-4 inline-block" /> by <a
                    class="underline font-bold"
                    href="https://x.com/nabilhassen08"
                >Nabil Hassen</a>
            </p>
            <div>
                <ul class="flex space-x-4">
                    <li>
                        <a
                            class="link link-hover"
                            href="#faq"
                        >
                            Terms & Conditions
                        </a>
                    </li>
                    <li>
                        <a
                            class="link link-hover"
                            href="#faq"
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
