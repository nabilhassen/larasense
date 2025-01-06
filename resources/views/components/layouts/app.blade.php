<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data
    x-bind:class="{ 'dark': $store.themeMode.isDark() }"
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

    <link
        rel="shortcut icon"
        href="favicon.png"
        type="image/x-png"
    >

    <title>Larasense - {{ $title ?? '' }}</title>

    <script>
        document.documentElement.classList.toggle(
            'dark',
            localStorage.themeMode === 'dark' || (!('themeMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        )
    </script>

    @livewireStyles
    @vite('resources/css/app.css')
</head>

<body class="antialiased text-stone-800 dark:text-stone-300 dark:bg-black min-h-screen">

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

    @livewireScriptConfig
    @vite('resources/js/app.js')
    @filepondScripts
    <x-update-timezone current-timezone="{{ auth()->user()->timezone }}" />
    @stack('scripts')
</body>

</html>
