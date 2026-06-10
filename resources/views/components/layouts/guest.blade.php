<!DOCTYPE html>
<html
    class="scroll-smooth"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>

<head>
    @include('components.layouts.partials.head')
</head>

<body class="antialiased dark:bg-black dark:text-stone-300 text-stone-700">
    {{ $slot }}

    @livewireScriptConfig

    @vite('resources/js/app.js')
    <x-update-timezone />
    @stack('scripts')
</body>

</html>
