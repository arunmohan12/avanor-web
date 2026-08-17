<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Avanor Capital')
    </title>


    {{-- =====================================================
        SEO
    ===================================================== --}}

    @hasSection('meta_description')
        <meta
            name="description"
            content="@yield('meta_description')">
    @endif


    @hasSection('meta_keywords')
        <meta
            name="keywords"
            content="@yield('meta_keywords')">
    @endif


    @hasSection('canonical')
        <link
            rel="canonical"
            href="@yield('canonical')">
    @endif


    {{-- =====================================================
        OPEN GRAPH
    ===================================================== --}}

    <meta
        property="og:type"
        content="website">

    <meta
        property="og:title"
        content="@yield('title', 'Avanor Capital')">


    @hasSection('meta_description')
        <meta
            property="og:description"
            content="@yield('meta_description')">
    @endif


    @hasSection('canonical')
        <meta
            property="og:url"
            content="@yield('canonical')">
    @endif


    @hasSection('og_image')
        <meta
            property="og:image"
            content="@yield('og_image')">
    @endif


    {{-- Extra page-specific meta --}}
    @stack('meta')


    {{-- =====================================================
        LANDING PAGE ASSETS
    ===================================================== --}}

    @vite([
        'resources/css/landingpages/the-heightsv2.css',
        'resources/js/landingpages/the-heights.js',
    ])


    {{-- Additional CSS if needed --}}
    @stack('styles')


    {{-- =====================================================
        STRUCTURED DATA
    ===================================================== --}}

    @stack('structured-data')

</head>


<body>

    @yield('content')


    {{-- Additional page-specific JS --}}
    @stack('scripts')

</body>

</html>