<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
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

    <div class="flex text-stone-800 p-9">
        <x-sidemenu />

        <div class="min-h-screen space-y-12 w-4/5">
            <x-topnavbar />

            {{ $slot }}
        </div>
    </div>

    @livewireScriptConfig
    @vite('resources/js/app.js')
    <x-update-timezone current-timezone="{{ auth()->user()->timezone }}" />
    @stack('scripts')
</body>

</html>
