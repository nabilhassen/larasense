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

    <title>{{ $title ?? 'Page Title' }}</title>

    @livewireStyles
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    {{ $slot }}

    <div class="mb-96"></div>

    @livewireScriptConfig
    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>
