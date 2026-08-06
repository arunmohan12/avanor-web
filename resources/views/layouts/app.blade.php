<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    @livewireStyles
</head>

<body>
    <!-- @include('partials.preloader') -->

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.contacticons')


       <!-- Legacy Template Scripts -->
       <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}" defer></script>
       <script src="{{ asset('assets/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/gsap.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery.datetimepicker.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/threesixty.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/panolens.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/map-place-active.js') }}" defer></script>
    <script src="{{ asset('assets/js/main.js') }}" defer></script>

    @stack('scripts')
    @livewireScripts
</body>

</html>