<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    @livewireStyles

    {{-- Meta Pixel --}}
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '28563967536521670');
        fbq('track', 'PageView');
    </script>
    {{-- End Meta Pixel --}}
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
    <!-- <script src="{{ asset('assets/js/map-place-active.js') }}" defer></script> -->
    <script src="{{ asset('assets/js/main.js') }}" defer></script>

    <footer class="footer-wrapper footer-default bg-theme">
@include('partials.footer')
</footer>
    @stack('scripts')
    @livewireScripts
</body>

</html>
