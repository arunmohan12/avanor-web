@extends('layouts.app')

@section('title', 'About Us')
@section('logo', 'logo-dark.svg')

@push('styles')
@vite('resources/css/vendor/contact.css')
@endpush

@section('content')

{{-- Hero --}}

<section class="space ">
    <div class="container mt-10 mb-10">
        <x-breadcrumb
            :items="[
        [
            'label' => 'Home',
            'url' => route('home'),
        ],
        [
            'label' => 'Contact',
        ],
    ]" />
    </div>
</section>



<div class="space-bottom">
    <div class="container avanor-contact-page">

        <div class="title-area text-center">
            <span class="sub-title">GET IN TOUCH</span>
            <h2 class="sec-title text-theme contact-title">Our Contact Information</h2>
        </div>
        <div class="row gy-4 justify-content-center">
            <div class="col-xl-4 col-lg-6">
                <div class="about-contact-grid style2">
                    <div class="about-contact-icon">
                        <i class="fal fa-location-dot"></i>
                    </div>
                    <div class="about-contact-details">
                        <h6 class="about-contact-details-title">Our Address</h6>
                        <p class="about-contact-details-text"> {{ $siteSettings['address'] ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="about-contact-grid style2">
                    <div class="about-contact-icon">
                        <i class="fal fa-phone"></i>
                    </div>
                    <div class="about-contact-details">
                        <h6 class="about-contact-details-title">Phone Number</h6>
                        <p class="about-contact-details-text">
                            @if (!empty($siteSettings['phone']))
                            <a href="tel:{{ preg_replace('/\s+/', '', $siteSettings['phone']) }}">
                                {{ $siteSettings['phone'] }}
                            </a>
                            @endif
                        </p>
                        <!-- <p class="about-contact-details-text"><a href="tel:01234567890">+09 876 543 210</a></p> -->
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="about-contact-grid style2">
                    <div class="about-contact-icon">
                        <i class="fal fa-envelope"></i>
                    </div>
                    <div class="about-contact-details">
                        <h6 class="about-contact-details-title">Email Address</h6>
                        <p class="about-contact-details-text">
                            <a href="mailto:{{ $siteSettings['email'] }}">
                                {{ $siteSettings['email'] }}
                            </a>

                        </p>

                        <!-- <p class="about-contact-details-text"><a href="mailto:support24@realar.com">support24@realar.com</a></p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="space bg-title-dark overflow-hidden" id="contact-sec">

    <div class="container">
        <div class="row gx-60 align-items-center">
            <div class="col-lg-2">

            </div>
            <div class="col-lg-8">
                <div class="title-area mb-35 head-contact text-center">
                    <span class="sub-title">CONNECT WITH US</span>
                    <h2 class="sec-title text-white">Book Business Solutions</h2>
                </div>
                <form action="mail.php" method="POST" class="appointment-form ajax-contact me-xl-5">
                    <div class="row">
                        <div class="form-group style-border3 col-md-6">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name*">
                            <i class="fal fa-user"></i>
                        </div>
                        <div class="form-group style-border3 col-md-6">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email*">
                            <i class="fal fa-envelope"></i>
                        </div>
                        <div class="form-group style-border3 col-md-12">
                            <input
                                type="tel"
                                id="contact_phone"
                                name="phone"
                                class="form-control"
                                placeholder="Phone Number*"
                                required>
                        </div>
                        <div class="col-12 form-group style-border3">
                            <i class="far fa-comments"></i>
                            <textarea placeholder="Type Your Message" class="form-control"></textarea>
                        </div>
                        <div class="col-12 form-btn mt-4">
                            <button class="th-btn style-border btn-cta">SUBMIT MESSAGE <span class="btn-icon"></span></button>
                        </div>
                    </div>
                    <p class="form-messages mb-0 mt-3"></p>
                </form>
            </div>
            <div class="col-lg-2">

            </div>
        </div>

    </div>
</div>

<div class="space position-relative overflow-hidden bg-brandlight mt-60" data-bg-src="{{ asset('assets/img/hero/lightbrand-banner.png')}}">
@include('partials.reachoutbanner')
</div>
<div class="client-area-1 space " data-bg-src="{{ asset('assets/img/hero/lightbrand-banner.png')}}">
@include('partials.developer-swiper-section')
</div>
<footer class="footer-wrapper footer-default bg-theme">
    @include('partials.footer')
</footer>
@endsection

@push('scripts')
@vite('resources/js/pages/contact.js')
@endpush