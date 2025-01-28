@use('Illuminate\Support\Facades\Vite')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, viewport-fit=cover"
    >

    @livewireStyles

    <style>
        {!! Vite::content('resources/css/app.css') !!}
    </style>
    <script>
        {!! Vite::content('resources/js/app.js') !!}
    </script>
</head>

<body class="antialiased bg-accent py-6 text-stone-800">

    <div class="container mx-auto space-y-6">
        <header class="flex justify-center items-center">
            <figure>
                <img
                    class="w-44"
                    src="{{ asset('img/logo.png') }}"
                    alt="Larasense logo"
                >
            </figure>
        </header>

        <main>
            {{ $slot }}
        </main>

        <footer class="sm:w-[640px] w-11/12 mx-auto sm:px-8 px-4 text-center flex flex-col items-center text-primary text-sm space-y-2">
            {{ $footer ?? null }}

            <div class="font-bold">
                Copyright © {{ date('Y') }} Larasense. All rights reserved.
            </div>
        </footer>
    </div>

</body>

</html>
