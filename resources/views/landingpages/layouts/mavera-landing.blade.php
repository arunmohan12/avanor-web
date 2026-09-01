<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Tag Manager - delayed for performance -->
    <script>
        window.dataLayer = window.dataLayer || [];

        (function (w, d, s, l, i) {

            let loaded = false;

            const events = [
                'pointerdown',
                'touchstart',
                'keydown',
                'scroll'
            ];

            function loadGTM() {

                if (loaded) {
                    return;
                }

                loaded = true;

                events.forEach(function (event) {
                    w.removeEventListener(event, loadGTM);
                });

                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });

                const script = d.createElement(s);

                script.async = true;

                script.src =
                    'https://www.googletagmanager.com/gtm.js?id=' +
                    i +
                    (l !== 'dataLayer' ? '&l=' + l : '');

                d.head.appendChild(script);
            }

            /*
             * Load immediately when the visitor interacts.
             */
            events.forEach(function (event) {
                w.addEventListener(
                    event,
                    loadGTM,
                    {
                        once: true,
                        passive: true
                    }
                );
            });

            /*
             * Otherwise load after the page has finished loading.
             */
            w.addEventListener('load', function () {

                setTimeout(loadGTM, 4000);

            }, { once: true });

        })(
            window,
            document,
            'script',
            'dataLayer',
            'GTM-NCXCP87F'
        );
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
        'resources/css/landingpages/mavera.css',
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
