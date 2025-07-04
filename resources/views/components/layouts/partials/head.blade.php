<meta charset="utf-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, viewport-fit=cover"
>

<meta
    name="csrf-token"
    content="{{ csrf_token() }}"
>

<meta name="theme-color" />

@guest
    <meta
        property="og:title"
        content="Larasense - {{ $title ?? '' }}"
    />

    <meta
        property="og:description"
        content="Stay updated on Laravel news, trends, and updates with curated content from top blogs, YouTube, and podcasts—all in a sleek, user-friendly design."
    />

    <meta
        name="description"
        content="Stay updated on Laravel news, trends, and updates with curated content from top blogs, YouTube, and podcasts—all in a sleek, user-friendly design."
    />

    <meta
        property="og:type"
        content="website"
    />

    <meta
        property="og:locale"
        content="en"
    />

    <meta
        property="og:image"
        content="{{ asset('img/og_image.webp') }}"
    />

    <meta
        property="og:url"
        content="{{ url()->current() }}"
    />

    <link
        rel="canonical"
        href="{{ url()->current() }}"
    />

    <meta
        name="twitter:card"
        content="summary_large_image"
    >

    <meta
        name="twitter:creator"
        content="@nabilhassen08"
    />

    <meta
        name="twitter:title"
        content="Larasense - {{ $title ?? '' }}"
    />

    <meta
        name="twitter:description"
        content="Stay updated on Laravel news, trends, and updates with curated content from top blogs, YouTube, and podcasts—all in a sleek, user-friendly design."
    />

    <meta
        name="twitter:image"
        content="{{ asset('img/og_image.webp') }}"
    />
@endguest

<title>Larasense - {{ $title ?? '' }}</title>

<link
    rel="icon"
    type="image/png"
    href="{{ asset('favicon.png') }}"
>

<link
    rel="preload"
    href="{{ asset('img/logo.png') }}"
    as="image"
    fetchpriority="high"
>

@if (request()->routeIs('home'))
    <link
        rel="preload"
        href="{{ asset('img/light_screenshot.webp') }}"
        as="image"
        fetchpriority="high"
    >
    
    <link
        rel="preload"
        href="{{ asset('img/dark_screenshot.webp') }}"
        as="image"
        fetchpriority="high"
    >
@endif

<script>
    function toggleDarkMode(params) {
        const isThemeDark = localStorage.getItem('themeMode') === 'dark' || (!('themeMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
        
        document.documentElement.classList.toggle('dark', isThemeDark);
        
        document
            .querySelector('meta[name="theme-color"]')
            .setAttribute(
                "content",
                isThemeDark ? 'black' : '#EF5A6F'
            );
    }

    toggleDarkMode();
    
    document.addEventListener('livewire:navigated', () => {
        toggleDarkMode();
    });
</script>

@livewireStyles

@vite('resources/css/app.css')

@production
    <!-- Google tag (gtag.js) -->
    <script
        async
        src="https://www.googletagmanager.com/gtag/js?id=G-XS5G6ZQC5P"
    ></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-XS5G6ZQC5P');
    </script>
@endproduction
