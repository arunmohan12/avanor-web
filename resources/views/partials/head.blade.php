<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
<title>@yield('title', 'Avanor Capital')</title>

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

<!-- <meta name="theme-color" content="#ffffff"> -->


@vite([
    'resources/css/app.css',
    'resources/js/app.js',
])

{{-- Page Specific CSS --}}
@stack('styles')