@extends('layouts.app')

@section('title', 'Home')

@push('styles')
@vite('resources/css/vendor/home.css')
@endpush

@section('content')

<!-- <div class="hero">
    
    <video
        class="hero-video"
        autoplay
        muted
        loop
        playsinline
        preload="metadata"
        poster="{{ asset('assets/img/banner-hom.webp') }}"
    >
        <source src="{{ asset('assets/videos/hero-video.mp4') }}" type="video/mp4">
    </video>
    
</div> -->

<div class="th-hero-wrapper hero-3 " id="hero" data-bg-src="{{ asset('assets/img/banner-hom.webp') }}">
    <video class="hero-video" id="video" src="{{ asset('assets/videos/hero-video.mp4') }}" loop="" muted="" autoplay="">
    </video>

</div>


<div class="bg-brandlight overflow-hidden pt-60 pb-60">
    <div class="container counter-sizer">
        <div class="counter-card-wrap">
            <div class="counter-card style4">
                <div class="media-body">
                <div class="box-icon">
                            <img src="assets/img/icon/counter-4-1.svg" alt="img">
                        </div>
                    <h2 class="box-number text-theme"><span class="counter-number text-theme">850</span>+</h2>
                    <p class="box-text text-theme">Elegant Apartments</p>
                </div>
            </div>
            <div class="counter-card style4">
                <div class="media-body">
                <div class="box-icon">
                            <img src="assets/img/icon/counter-4-2.svg" alt="img">
                        </div>
                    <h2 class="box-number text-theme"><span class="counter-number text-theme">950</span>+</h2>
                    <p class="box-text text-theme">Luxury Houses</p>
                </div>
            </div>
            <div class="counter-card style4">
                <div class="media-body">
                <div class="box-icon">
                            <img src="assets/img/icon/counter-4-3.svg" alt="img">
                        </div>
                    <h2 class="box-number text-theme"><span class="counter-number text-theme">18</span>k+</h2>
                    <p class="box-text text-theme">Satisfied Guests</p>
                </div>
            </div>
            <div class="counter-card style4">
                <div class="media-body">
                <div class="box-icon">
                            <img src="assets/img/icon/counter-4-4.svg" alt="img">
                        </div>
                    <h2 class="box-number text-theme"><span class="counter-number text-theme">2</span>k+</h2>
                    <p class="box-text text-theme">Happy Owners</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="home-filter-section space-top filter-home-bottom ">


    <div class="container filter-sizer">
        <div>
            <span class="sub-title-dark">Top-Notch Real Estate Properties</span>
            <h1 class="hero-title brand-light">Find Your </h1>
            <h1 class="hero-title brand-light">Dream Home</h1>


        </div>
        @include('partials.property-search')
    </div>




</section>


<section class="overflow-hidden space overflow-hidden bg-brandlight">
    @include('partials.homecomunitysection')
</section>


<section class="space bg-branddark" id="property-sec">
@include('partials.property-swiper-section')
</section>


<div class="space-top position-relative overflow-hidden bg-brandlight" data-bg-src="{{ asset('assets/img/hero/lightbrand-banner.webp')}}">
@include('partials.reachoutbanner')
</div>
<!--==============================
Client Area  
==============================-->
<div class="client-area-1 space " data-bg-src="{{ asset('assets/img/hero/lightbrand-banner.webp')}}">

@include('partials.developer-swiper-section')
</div>
@endsection