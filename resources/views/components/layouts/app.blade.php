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
    {{ $slot }}

    @livewireScriptConfig
    @vite('resources/js/app.js')
    <script>
        window.onload = function() {
            const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

            if (timezone !== '{{ session()->get('timezone') }}') {
                axios.post('{{ route('timezone.update') }}', {
                    timezone
                });
            }
        }
    </script>
    @stack('scripts')
</body>

</html>
