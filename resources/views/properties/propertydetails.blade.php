@extends('layouts.app')

@section('title', 'About Us')
@section('logo', 'logo-dark.svg')

@push('styles')
@vite('resources/css/vendor/propertydetails.css')
@vite('resources/css/vendor/contact.css')

@endpush

@section('content')
<section class="avanor-property-hero">

    <div class="swiper avanor-property-gallery">

        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <img
                    src="{{ asset('assets/img/property/CHEVALIA_ESTATE_GRAND_POLO_IMAGE3.jpg') }}"
                    alt="Luxury property exterior"
                    class="avanor-property-hero-image"
                    fetchpriority="high">
            </div>

            <div class="swiper-slide">
                <img
                    src="{{ asset('assets/img/property/CHEVALIA_ESTATE_GRAND_POLO_IMAGE8.webp') }}"
                    alt="Luxury property view"
                    class="avanor-property-hero-image"
                    loading="lazy">
            </div>

            <div class="swiper-slide">
                <img
                    src="{{ asset('assets/img/property/CHEVALIA_ESTATE_GRAND_POLO_IMAGE15.webp') }}"
                    alt="Luxury property community"
                    class="avanor-property-hero-image"
                    loading="lazy">
            </div>

            <div class="swiper-slide">
                <img
                    src="{{ asset('assets/img/property/CHEVALIA_ESTATE_GRAND_POLO_IMAGE20.webp') }}"
                    alt="Luxury property community"
                    class="avanor-property-hero-image"
                    loading="lazy">
            </div>
            <div class="swiper-slide">
                <img
                    src="{{ asset('assets/img/property/CHEVALIA_ESTATE_GRAND_POLO_IMAGE23.webp') }}"
                    alt="Luxury property community"
                    class="avanor-property-hero-image"
                    loading="lazy">
            </div>

        </div>

        <button
            type="button"
            class="avanor-property-gallery-prev"
            aria-label="Previous image">
            <i class="far fa-chevron-left"></i>
        </button>

        <button
            type="button"
            class="avanor-property-gallery-next"
            aria-label="Next image">
            <i class="far fa-chevron-right"></i>
        </button>

        <div class="swiper-pagination avanor-property-gallery-pagination"></div>

    </div>

</section>
<section>
    <div class="container mt-10 mb-10">
        <x-breadcrumb
            :items="[
        [
            'label' => 'Home',
            'url' => route('home'),
        ],
        [
            'label' => 'Emaar',
        ],
        [
            'label' => 'Property name',
        ],
    ]" />
    </div>
</section>
<section class="space-bottom space-extra-bottom">
    <div class="container">

        <div class="row gx-30">
            <div class="col-xxl-8 col-lg-7">
                <div class="property-page-single">
                    <div class="page-content">

                        <h2 class="page-title">Golf Trails at Emaar South</h2>
                        <p>voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur</p>

                        <section class=" avanor-property-facts">
                            <div class="avanor-property-facts-grid">

                                <div class="avanor-property-fact-card">
                                    <span class="avanor-property-fact-label">
                                        Starting Price
                                    </span>

                                    <h3 class="avanor-property-fact-value">
                                        AED 1,250,000
                                    </h3>
                                </div>


                                <div class="avanor-property-fact-card">
                                    <span class="avanor-property-fact-label">
                                        Unit Type
                                    </span>

                                    <h3 class="avanor-property-fact-value">
                                        1 - 3 BR Apartments
                                    </h3>
                                </div>


                                <div class="avanor-property-fact-card">
                                    <span class="avanor-property-fact-label">
                                        Unit Type
                                    </span>

                                    <h3 class="avanor-property-fact-value">
                                        3 BR Townhouses
                                    </h3>
                                </div>


                                <div class="avanor-property-fact-card">
                                    <span class="avanor-property-fact-label">
                                        Handover Date
                                    </span>

                                    <h3 class="avanor-property-fact-value">
                                        Q4 2030
                                    </h3>
                                </div>


                                <div class="avanor-property-fact-card">
                                    <span class="avanor-property-fact-label">
                                        Payment Plan
                                    </span>

                                    <h3 class="avanor-property-fact-value">
                                        80/20
                                    </h3>
                                </div>

                            </div>
                        </section>

                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-lg-5">
                <aside class="sidebar-area">
                    <div class="widget widget-property-contact">

                        <p class="widget_text">Register Your Interest</p>
                        <form action="#" class="widget-property-contact-form">
                            <div class="form-group">
                                <input type="text" class="form-control style-border" placeholder="FIRST NAME">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control style-border" placeholder="LAST NAME">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control style-border" placeholder="EMAIL ADDRESS">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control style-border" placeholder="PREFERRED BUDGET (E.G AED 2M - 5M)">
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

                            <button class="th-btn style-white th-btn-icon mt-15 avanor-register-btn">REGISTER YOUR INTEREST</button>
                        </form>
                    </div>


                </aside>
            </div>
            <div class="col-xxl-12">
                <div class="overflow-hidden space" id="about-sec">

                    <div class="container">

                        <div class="about-page-wrap">
                            <div class="row gy-40 property-detail-row  justify-content-between align-items-center">

                                <div class="col-lg-6">
                                    <div class="img-box3">
                                        <div class="img1">
                                            <img src="assets/img/property/rhrbvdewfwuiiko2qlmk.avif" alt="About">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div>
                                        <span class="sub-title-dark">
                                            LIVING IN THE MARINA VIEWS
                                        </span>
                                    </div>

                                    <p class="text-theme">
                                        Choose between masterfully detailed and expansive 1-, 2-, 3- and 4-bedroom apartments with panoramic windows offering endless water and outdoor living space views. Designed to be a contemporary residential oasis which offers tranquil surroundings and exciting nearby attractions. Has a landscaped amenity platform featuring a variety of world-class amenities.
                                    </p>
                                </div>


                                <div class="col-lg-6 ">
                                    <div class="title-area mb-0">
                                        <div>
                                            <span class="sub-title-dark">
                                                LIVING IN THE MARINA VIEWS
                                            </span>
                                        </div>

                                        <p class="mb-0 text-theme">
                                            You are the center of our process. Your needs, your wants,
                                            and your goals. Full transparency is our goal. We stay connected while
                                            building your home.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-6 ">
                                    <div class="img-box3">
                                        <div class="img1">
                                            <img src="assets/img/property/rhrbvdewfwuiiko2qlmk.avif" alt="About">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="title-area mb-0">
                                        <div>
                                            <span class="sub-title-dark project-about-heading">
                                                ABOUT PROJECT
                                            </span>
                                        </div>

                                        <p class="mb-0 text-theme">
                                            Choose between masterfully detailed and expansive 1-, 2-, 3- and 4-bedroom apartments with panoramic windows offering endless water and outdoor living space views. Designed to be a contemporary residential oasis which offers tranquil surroundings and exciting nearby attractions. Has a landscaped amenity platform featuring a variety of world-class amenities.

                                        </p>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="title-area mb-0">
                                        <div>
                                            <span class="sub-title-dark project-about-heading">
                                                GALLERY
                                            </span>
                                        </div>


                                        <div class="slider-area property-slider1">
                                            <div class="swiper th-slider mb-4" id="propertySlider" data-slider-options='{"effect":"fade","loop":true,"thumbs":{"swiper":".property-thumb-slider"},"autoplayDisableOnInteraction":"true"}'>
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <div class="property-slider-img">
                                                            <img src="{{ asset('assets/img/property/CHEVALIA_ESTATE_GRAND_POLO_IMAGE15.webp') }}" alt="img">
                                                        </div>
                                                    </div>

                                                    <div class="swiper-slide">
                                                        <div class="property-slider-img">
                                                            <img src="{{ asset('assets/img/property/CHEVALIA_ESTATE_GRAND_POLO_IMAGE8.webp') }}" alt="img">
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="property-slider-img">
                                                            <img src="{{ asset('assets/img/property/CHEVALIA_ESTATE_GRAND_POLO_IMAGE20.webp') }}" alt="img">
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="property-slider-img">
                                                            <img src="{{ asset('assets/img/property/CHEVALIA_ESTATE_GRAND_POLO_IMAGE23.webp') }}" alt="img">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="swiper th-slider property-thumb-slider" data-slider-options='{"effect":"slide","loop":true,"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}},"autoplayDisableOnInteraction":"true"}'>
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <div class="property-slider-img">
                                                            <img src="{{ asset('assets/img/property/CHEVALIA_ESTATE_GRAND_POLO_IMAGE15.webp') }}" alt="Image">
                                                        </div>
                                                    </div>

                                                    <div class="swiper-slide">
                                                        <div class="property-slider-img">
                                                            <img src="{{ asset('assets/img/property/CHEVALIA_ESTATE_GRAND_POLO_IMAGE8.webp') }}" alt="Image">
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="property-slider-img">
                                                            <img src="{{ asset('assets/img/property/CHEVALIA_ESTATE_GRAND_POLO_IMAGE20.webp') }}" alt="Image">
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="property-slider-img">
                                                            <img src="{{ asset('assets/img/property/CHEVALIA_ESTATE_GRAND_POLO_IMAGE23.webp') }}" alt="Image">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <button data-slider-prev="#propertySlider" class="slider-arrow style3 slider-prev"> <i class="far fa-chevron-left"></i></button>
                                            <button data-slider-next="#propertySlider" class="slider-arrow style3 slider-next"> <i class="far fa-chevron-right"></i></button>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="title-area mb-0">
                                                <div>
                                                    <span class="sub-title-dark project-about-heading">
                                                        Amenities
                                                    </span>
                                                </div>

                                                <div class="row gy-3">
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="checklist">
                                                            <ul>
                                                                <li><i class="far fa-square-check"></i>Airconditioning</li>
                                                                <li><i class="far fa-square-check"></i>Balcony</li>
                                                                <li><i class="far fa-square-check"></i>Garage</li>
                                                                <li><i class="far fa-square-check"></i>Landscaping</li>
                                                                <li><i class="far fa-square-check"></i>Outdoor Kitchen</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="checklist">
                                                            <ul>
                                                                <li><i class="far fa-square-check"></i>Barbeque</li>
                                                                <li><i class="far fa-square-check"></i>Recreation</li>
                                                                <li><i class="far fa-square-check"></i>Microwave</li>
                                                                <li><i class="far fa-square-check"></i>Basketball</li>
                                                                <li><i class="far fa-square-check"></i>Fireplace</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="checklist">
                                                            <ul>
                                                                <li><i class="far fa-square-check"></i>24x7 Seccurity</li>
                                                                <li><i class="far fa-square-check"></i>Indoor Game</li>
                                                                <li><i class="far fa-square-check"></i>Pool</li>
                                                                <li><i class="far fa-square-check"></i>Tanis Courts</li>
                                                                <li><i class="far fa-square-check"></i>Internet</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="checklist">
                                                            <ul>
                                                                <li><i class="far fa-square-check"></i>Jaguzzi</li>
                                                                <li><i class="far fa-square-check"></i>Modern Kitchen</li>
                                                                <li><i class="far fa-square-check"></i>Refrigerator</li>
                                                                <li><i class="far fa-square-check"></i>Window Coverings</li>
                                                                <li><i class="far fa-square-check"></i>Washer</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 space-top">
                                            <div class="title-area mb-0">
                                                <div>
                                                    <span class="sub-title-dark project-about-heading">
                                                        LOCATION
                                                    </span>
                                                </div>

                                                <div class="location-map">
                                                    <div class="contact-map">
                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3644.7310056272386!2d89.2286059153658!3d24.00527418490799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fe9b97badc6151%3A0x30b048c9fb2129bc!2sAngfuztheme!5e0!3m2!1sen!2sbd!4v1651028958211!5m2!1sen!2sbd" allowfullscreen="" loading="lazy"></iframe>
                                                    </div>
                                                    <div class="location-map-address">
                                                        <div class="thumb">
                                                            <img src="assets/img/property/property_inner_1.jpg" alt="img">
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="title">Address:</h4>
                                                            <p class="text">Brooklyn, New York 11233, United States</p>
                                                            <h4 class="title">Post Code:</h4>
                                                            <p class="text">12345</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</section>
@endsection
@push('scripts')
@vite('resources/js/pages/propertydetails.js')
@vite('resources/js/pages/contact.js')
@endpush