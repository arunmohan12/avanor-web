<!doctype html>
<html class="no-js" lang="zxx" dir="ltr">

<head>
    @include('partials.head')

    @stack('styles')
</head>

<body>

    {{-- Preloader --}}
    @include('partials.preloader')

    {{-- Mobile Menu --}}
    @include('partials.mobile-menu')

    {{-- Side Menu --}}
    @include('partials.side-menu')

    {{-- Header --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>
    {{-- Footer --}}
    @include('partials.footer')

    {{-- Common Scripts --}}
    @include('partials.scripts')

    {{-- Page Specific Scripts --}}
    @stack('scripts')
</body>

</html>