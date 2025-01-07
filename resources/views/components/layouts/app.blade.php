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

    <meta
        name="theme-color"
        media="(prefers-color-scheme: light)"
        content=""
    />


    <link
        rel="shortcut icon"
        href="favicon.png"
        type="image/x-png"
    >

    <title>Larasense - {{ $title ?? '' }}</title>

    <script>
        let isDark = localStorage.getItem('themeMode') === 'dark' || (!('themeMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

        document.documentElement.classList.toggle('dark', isDark);
        document.querySelector('meta[name="theme-color"]').setAttribute("content", isDark ? 'black' : '#EF5A6F');
    </script>

    @livewireStyles
    @vite('resources/css/app.css')
</head>

<body @class([
    'antialiased dark:bg-black dark:text-stone-300',
    'text-stone-800 min-h-screen' => auth()->check(),
    'text-stone-700' => !auth()->check(),
])>

    @auth
        <div class="container mx-auto">
            <div class="flex justify-center lg:gap-x-16 max-lg:mx-4">
                <x-sidemenu />

                <div class="lg:w-4/5 w-full">
                    <x-topnavbar />

                    <div class="lg:pb-8 pb-24 max-lg:pt-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <x-bottomnavbar />
        </div>

        <livewire:suggest-source-modal />

        <livewire:report-bugs-modal />

        <livewire:materials.modal />
    @endauth

    @guest
        {{ $slot }}
    @endguest

    @livewireScriptConfig
    @auth
        @filepondScripts
    @endauth
    @vite('resources/js/app.js')
    <x-update-timezone />
    @stack('scripts')
</body>

</html>
