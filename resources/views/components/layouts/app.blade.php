<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

    @livewireStyles
    @vite('resources/css/app.css')
</head>

<body class="antialiased">

    <div class="container mx-auto">
        <div class="flex justify-center lg:gap-x-16 text-stone-800 max-lg:mx-4">
            <x-sidemenu />

            <div class="lg:w-4/5">
                <x-topnavbar />

                {{ $slot }}
            </div>
        </div>

        <x-bottomnavbar />
    </div>

    <x-material-modal />

    @livewireScriptConfig
    @vite('resources/js/app.js')
    <x-update-timezone current-timezone="{{ auth()->user()->timezone }}" />
    @stack('scripts')
</body>

</html>
