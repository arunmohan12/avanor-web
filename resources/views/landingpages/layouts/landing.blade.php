<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){
            w[l]=w[l]||[];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event:'gtm.js'
            });

            var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),
                dl=l!='dataLayer' ? '&l='+l : '';

            j.async=true;
            j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;

            f.parentNode.insertBefore(j,f);

        })(window,document,'script','dataLayer','GTM-NCXCP87F');
    </script>
    <!-- End Google Tag Manager -->

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    @hasSection('robots')
        <meta name="robots" content="@yield('robots')">
    @endif

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
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NCXCP87F"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    @yield('content')


    {{-- Additional page-specific JS --}}
    @stack('scripts')

</body>

</html>
