<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
<title>@yield('title', 'Avanor Capital')</title>

<meta property="og:title" content="@yield('title', 'Avanor Capital')">
@if (! app()->environment('production'))
    <meta name="robots" content="noindex, nofollow">
@endif
@if (trim($__env->yieldContent('meta_description')))
    <meta
        name="description"
        content="@yield('meta_description')"
    >
@endif

@if (trim($__env->yieldContent('meta_keywords')))
    <meta
        name="keywords"
        content="@yield('meta_keywords')"
    >
@endif

@if (trim($__env->yieldContent('canonical')))
    <link rel="canonical" href="@yield('canonical')">
@endif


@if (trim($__env->yieldContent('meta_description')))
    <meta property="og:description" content="@yield('meta_description')">
@endif

@if (trim($__env->yieldContent('canonical')))
    <meta property="og:url" content="@yield('canonical')">
@endif

<meta property="og:type" content="@yield('og_type', 'website')">

@if (trim($__env->yieldContent('og_image')))
    <meta property="og:image" content="@yield('og_image')">
@endif

<script type="application/ld+json">
{!! json_encode([
    chr(64) . 'context' => 'https://schema.org',
    '@type' => 'Organization',
    '@id' => url('/') . '/#organization',
    'name' => 'Avanor Capital',
    'url' => url('/'),
    'logo' => asset('assets/img/logo-dark.svg'),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode([
    chr(64) . 'context' => 'https://schema.org',
    '@type' => 'WebSite',
    '@id' => url('/') . '/#website',
    'url' => url('/'),
    'name' => 'Avanor Capital',
    'publisher' => [
        '@id' => url('/') . '/#organization',
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

@stack('structured-data')

@vite([
    'resources/css/app.css',
    'resources/js/app.js',
])

{{-- Page Specific CSS --}}
@stack('styles')