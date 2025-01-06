<!DOCTYPE html>
<html
    class="scroll-smooth"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>

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

    <script>
        document.documentElement.classList.toggle(
            'dark',
            window.matchMedia('(prefers-color-scheme: dark)').matches
        )
    </script>

    @livewireStyles
    @vite('resources/css/app.css')
</head>

<body class="antialiased dark:bg-stone-900 text-stone-700 dark:text-stone-300">
    {{ $slot }}

    @livewireScriptConfig
    @vite('resources/js/app.js')
    <x-update-timezone current-timezone="{{ session()->get('timezone') }}" />
    @stack('scripts')
</body>

</html>
