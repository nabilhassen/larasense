<!DOCTYPE html>
<html
    class="scroll-smooth"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, viewport-fit=cover"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <meta name="theme-color" />

    <x-layouts.guest-meta-tags :$title />

    <title>Larasense - {{ $title ?? '' }}</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('favicon.png') }}"
    >

    <link
        rel="preload"
        href="{{ asset('img/logo.png') }}"
        as="image"
        fetchpriority="high"
    >

    @if (request()->routeIs('home'))
        <link
            rel="preload"
            href="{{ asset('img/light_screenshot.webp') }}"
            as="image"
            fetchpriority="high"
        >

        <link
            rel="preload"
            href="{{ asset('img/dark_screenshot.webp') }}"
            as="image"
            fetchpriority="high"
        >
    @endif

    <script>
        function toggleDarkMode(params) {
            const isThemeDark = localStorage.getItem('themeMode') === 'dark' || (!('themeMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

            document.documentElement.classList.toggle('dark', isThemeDark);

            document
                .querySelector('meta[name="theme-color"]')
                .setAttribute(
                    "content",
                    isThemeDark ? 'black' : '#EF5A6F'
                );
        }

        toggleDarkMode();

        document.addEventListener('livewire:navigated', () => {
            toggleDarkMode();
        });
    </script>

    @livewireStyles
    @vite('resources/css/app.css')

    <x-layouts.gtag />
</head>

<body class="antialiased dark:bg-black dark:text-stone-300 text-stone-700">
    {{ $slot }}

    @livewireScriptConfig

    @vite('resources/js/app.js')
    <x-update-timezone />
    @stack('scripts')
</body>

</html>
