@extends('layouts.app')

@section(
    'title',
    'Find Your Place in Dubai | Avanor Capital'
)

@section(
    'meta_description',
    'Discover standout properties, iconic developments and sought-after communities across Dubai and the UAE with Avanor Capital.'
)
@section(
'canonical',
url('/')
)

@section(
'og_type',
'website'
)
@section(
'og_image',
asset('assets/img/avanor-og.jpg')
)
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

@php
$heroVideo = $homeSettings?->hero_video
? \App\Support\MediaUrl::get($homeSettings->hero_video)
: asset('assets/videos/hero-video-old.mp4');

$heroPoster = $homeSettings?->hero_poster
? \App\Support\MediaUrl::get($homeSettings->hero_poster)
: asset('assets/img/banner-hom.webp');
@endphp

<div
    class="th-hero-wrapper hero-3"
    id="hero"
    style="background-image: url('{{ $heroPoster }}')">

    <video
        class="hero-video"
        id="video"
        src="{{ $heroVideo }}"
        poster="{{ $heroPoster }}"
        loop
        muted
        autoplay
        playsinline
        preload="metadata"></video>

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
            <span class="sub-title-dark"> Premium Real Estate Across the UAE</span>
            <h1 class="hero-title brand-light">
                <span>Find Your</span>
                <span>Dream Home</span>
            </h1>


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


<div class="position-relative overflow-hidden bg-brandlight mt-60" data-bg-src="{{ asset('assets/img/hero/lightbrand-banner.png')}}">
    @include('partials.reachoutbanner')
</div>

<div class="client-area-1 space " data-bg-src="{{ asset('assets/img/hero/lightbrand-banner.png')}}">
    @include('partials.developer-swiper-section')
</div>

<section class="space bg-branddark ">
    @include('partials.service-section')
</section>


<section class="why-sec2 space overflow-hidden ">
    @include('partials.approach-section')
</section>


<section class="space avanor-developers-section">
    @include('partials.developers-section')
</section>


<section class="space-top space-bottom avanor-blog-section">
    @include('partials.blogs-section')

</section>



@php
$developersForJs = collect($developers)->map(function ($developer) {
$developer['logo_url'] = !empty($developer['logo'])
? \App\Support\MediaUrl::get($developer['logo'])
: asset('assets/img/default-developer-logo.webp');

return $developer;
})->values();
@endphp

<script>
    window.avanorDevelopers = @json($developersForJs);
</script>

@endsection

@push('scripts')
@vite('resources/js/pages/home.js')
@endpush