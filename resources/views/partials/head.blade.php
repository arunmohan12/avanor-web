<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>@yield('title', 'Avanor')</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">

<!-- Magnific Popup -->
<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">

<!-- Swiper -->
<link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">

<!-- Datetime Picker -->
<link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}">

<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

{{-- Page Specific CSS --}}
@stack('styles')