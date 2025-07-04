<!DOCTYPE html>
<html
    class="scroll-smooth"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>

<head>
    @include('components.layouts.partials.head')
</head>

<body class="antialiased dark:bg-black dark:text-stone-300 text-stone-800 min-h-screen">

    <div class="container mx-auto">
        <div class="flex justify-center lg:gap-x-16 max-lg:mx-4">
            <x-sidemenu />

            <div class="lg:w-4/5 w-full">
                <x-topnavbar />

                <div class="lg:pb-8 pb-24 max-lg:pt-1">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <x-bottomnavbar />
    </div>

    <livewire:suggest-source-modal />

    <livewire:report-bugs-modal />

    <livewire:materials.modal />

    <x-login-required-modal />

    @livewireScriptConfig

    @auth
        @filepondScripts
    @endauth

    @vite('resources/js/app.js')
    <x-update-timezone />
    @stack('scripts')
</body>

</html>
