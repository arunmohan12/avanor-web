<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>@yield('title', 'Avanor')</title>

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