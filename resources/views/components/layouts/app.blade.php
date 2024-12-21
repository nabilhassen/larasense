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

    <div class="lg:container lg:mx-auto">
        <div class="flex lg:gap-x-16 text-stone-800 lg:m-9 mx-4">
            <x-sidemenu />

            <div class="min-h-screen space-y-12 lg:w-4/5 w-full">
                <x-topnavbar />

                {{ $slot }}
            </div>
        </div>

        <x-bottomnavbar />
    </div>

    @livewireScriptConfig
    @vite('resources/js/app.js')
    <x-update-timezone current-timezone="{{ auth()->user()->timezone }}" />
    @stack('scripts')
</body>

</html>
