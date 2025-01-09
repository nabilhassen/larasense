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
