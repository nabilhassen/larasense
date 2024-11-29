<div class="navbar bg-white rounded-box w-auto mx-4 sm:mx-0 shadow-md shadow-[#EF5A6F]">
    <div class="navbar-start">
        <div class="dropdown">
            <div
                tabindex="0"
                role="button"
                class="btn btn-ghost lg:hidden"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 stroke-[#EF5A6F]"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h8m-8 6h16"
                    />
                </svg>
            </div>
            <ul
                tabindex="0"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow"
            >
                <li><a>Home</a></li>
                <li><a>Features</a></li>
                <li><a>Benefits</a></li>
                <li><a>Sources</a></li>
                <li><a>FAQ</a></li>
            </ul>
        </div>
        <a class="btn btn-ghost text-xl hover:!bg-inherit">
            <img
                class="sm:w-52 w-48"
                src="{{ asset('img/logo.png') }}"
                alt="Larasense logo"
            >
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1 font-semibold">
            <li>
                <a
                    class="hover:bg-[#FFF1DB] active:!bg-[#FFF1DB] focus:!bg-[#FFF1DB] active:!text-inherit"
                    href="{{ route('home') }}"
                    wire:navigate
                >
                    Home
                </a>
            </li>
            <li>
                <a
                    class="hover:bg-[#FFF1DB] active:!bg-[#FFF1DB] focus:!bg-[#FFF1DB] active:!text-inherit"
                    href="#sources"
                >
                    Sources
                </a>
            </li>
            <li>
                <a
                    class="hover:bg-[#FFF1DB] active:!bg-[#FFF1DB] focus:!bg-[#FFF1DB] active:!text-inherit"
                    href="#benefits"
                >
                    Benefits
                </a>
            </li>
            <li>
                <a
                    class="hover:bg-[#FFF1DB] active:!bg-[#FFF1DB] focus:!bg-[#FFF1DB] active:!text-inherit"
                    href="#faq"
                >
                    FAQ
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-end gap-x-2">
        <a class="btn btn-outline text-[#EF5A6F] hidden hover:bg-[#EF5A6F] hover:border-[#EF5A6F] sm:inline-flex">Login</a>
        <a class="btn bg-[#EF5A6F] font-bold text-white border-none hover:bg-[#EF5A6F] hover:brightness-90">Join Now</a>
    </div>
</div>
