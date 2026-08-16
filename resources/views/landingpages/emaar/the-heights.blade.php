@extends('landingpages.layouts.landing')


{{-- =====================================================
    SEO
===================================================== --}}

@if (!empty($propertyImageUrl))
@section('og_image', $propertyImageUrl)
@endif

@section(
'title',
$property->meta_title ?: $property->title . ' | Avanor Capital'
)

@section(
'meta_description',
$property->meta_description
?: \Illuminate\Support\Str::limit(
strip_tags($property->description ?? ''),
155
)
)

@if (filled($property->meta_keywords))
@section('meta_keywords', $property->meta_keywords)
@endif

@section(
'canonical',
route('properties.show', $property->slug)
)


{{-- Ad landing page - do not index --}}
@push('meta')
<meta name="robots" content="noindex,follow">
@endpush


{{-- =====================================================
    STRUCTURED DATA
===================================================== --}}

@php
$displayPrice =
$property->price
?: $property->project?->starting_price;

$propertySchema = [
'@context' => 'https://schema.org',
'@type' => 'RealEstateListing',

'name' => $property->title,

'description' =>
$property->meta_description
?: \Illuminate\Support\Str::limit(
strip_tags($property->description ?? ''),
155
),

'url' => route(
'properties.show',
$property->slug
),
];

if (!empty($propertyImageUrl)) {
$propertySchema['image'] = [
$propertyImageUrl
];
}

if ($property->project?->location) {
$propertySchema['address'] = [
'@type' => 'PostalAddress',
'addressLocality' => $property->project->location,
'addressCountry' => 'AE',
];
}

if ($displayPrice) {
$propertySchema['offers'] = [
'@type' => 'Offer',
'priceCurrency' => 'AED',
'price' => $displayPrice,
'url' => route(
'properties.show',
$property->slug
),
];
}
@endphp


@push('structured-data')
<script type="application/ld+json">
    {
        !!json_encode(
            $propertySchema,
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        ) !!
    }
</script>
@endpush


@section('content')


<header class="landing-header">
    <div class="landing-header-inner">

        <!-- <a href="#home" class="landing-logo">
            <img
                src="{{ asset('assets/img/logo-dark.svg') }}"
                alt="Avanor">
        </a> -->

        <a href="#home" class="landing-logo">
            <img
                src="{{ asset('assets/img/Avanor-lp.png') }}"
                alt="Avanor">
        </a>
        <nav class="landing-nav">

            <a href="#home">Home</a>

            <a href="#property-details">
                Property Details
            </a>

            <a href="#about">
                About
            </a>

            <a href="#gallery">
                Gallery
            </a>

            <a href="#location">
                Location
            </a>

        </nav>
        <div class="landing-header-actions">

            <a
                href="https://wa.me/+971589798257"
                class="landing-header-whatsapp"
                aria-label="WhatsApp">

                <img
                    src="{{ asset('assets/img/whatsapp.svg') }}"
                    alt="WhatsApp">

            </a>
            <a
                href="#"
                class="landing-header-btn " data-lead-popup-open>
                REGISTER YOUR INTEREST
            </a>
            <button
                type="button"
                class="landing-menu-toggle"
                id="landingMenuToggle"
                aria-label="Open menu"
                aria-expanded="false">

                <span></span>
                <span></span>
                <span></span>

            </button>

        </div>

    </div>

    <div
        class="landing-mobile-menu"
        id="landingMobileMenu">

        <nav class="landing-mobile-nav">

            <a href="#home">Home</a>

            <a href="#property-details">
                Property Details
            </a>

            <a href="#about">About</a>

            <a href="#gallery">Gallery</a>

            <a href="#location">Location</a>

            <a
                href="#"
                class="landing-mobile-contact " data-lead-popup-open>
                Register Now
            </a>

        </nav>

    </div>

    </div>
</header>

<main>

    @if ($hasHeroImages)

    <section class="avanor-property-hero" id="home">

        <div class="swiper avanor-property-gallery">

            <div class="swiper-wrapper">

                {{-- COVER IMAGE --}}
                @if ($coverMedia)

                @php
                $coverUrl = \App\Support\MediaUrl::fromMedia(
                $coverMedia,
                'cover_avif'
                );
                @endphp

                <div class="swiper-slide">
                    <img
                        src="{{ $coverUrl }}"
                        alt="{{ $property->title }}"
                        class="avanor-property-hero-image"
                        fetchpriority="high">
                </div>

                @endif


                {{-- FIRST 2 GALLERY IMAGES ONLY --}}
                @foreach ($heroGalleryImages as $image)

                @php
                $imageUrl = \App\Support\MediaUrl::fromMedia(
                $image,
                'gallery_avif'
                );
                @endphp

                <div class="swiper-slide">
                    <img
                        src="{{ $imageUrl }}"
                        alt="{{ $property->title }}"
                        class="avanor-property-hero-image"
                        loading="lazy"
                        decoding="async">
                </div>

                @endforeach

            </div>

            @if ($galleryImages->count() > 1)

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

            @endif

        </div>

    </section>

    @endif


    <div
        class="landing-property-bar"
        id="landingPropertyBar">

        <div class="landing-property-bar-inner">

            <div class="landing-property-info">

                <span class="landing-property-developer">
                    {{ $property->developer?->name }}
                </span>

                <h1 class="landing-property-name">
                    {{ $property->title }}
                </h1>

            </div>

            <div class="landing-property-actions">

                <a
                    href="#"
                    class="landing-property-btn landing-property-btn-outline" data-lead-popup-open>
                    DOWNLOAD BROCHURE
                </a>

                <a
                    href="#"
                    class="landing-property-btn landing-property-btn-primary" data-lead-popup-open>
                    DOWNLOAD PAYMENT PLAN
                </a>

            </div>

        </div>

    </div>

    <section class="space space-extra-bottom">

        <div class="container custom-container">

            <div class="row gx-30">


                {{-- =====================================================
                PROPERTY OVERVIEW
            ===================================================== --}}
                <div class="col-xxl-8 col-lg-7" id="property-details">

                    <div class="property-page-single">

                        <div class="page-content">

                            <h2 class="page-title">
                                {{ $property->title }}
                            </h2>


                            @if (filled($property->description))

                            <div class="text-theme">
                                {!! $property->description !!}
                            </div>

                            @endif



                            {{-- =============================================
                            PROPERTY FACTS
                        ============================================= --}}
                            @if ($hasFacts)

                            <section class="avanor-property-facts">

                                <div class="avanor-property-facts-grid">


                                    {{-- Starting Price --}}
                                    @if (filled($property->starting_price))

                                    <div class="avanor-property-fact-card">

                                        <span class="avanor-property-fact-label">
                                            Starting Price
                                        </span>

                                        <h3 class="avanor-property-fact-value">
                                            AED {{ number_format($property->starting_price) }}
                                        </h3>

                                    </div>

                                    @elseif (filled($property->price))

                                    <div class="avanor-property-fact-card">

                                        <span class="avanor-property-fact-label">
                                            Property Price
                                        </span>

                                        <h3 class="avanor-property-fact-value">
                                            AED {{ number_format($property->price) }}
                                        </h3>

                                    </div>

                                    @endif



                                    {{-- Unit Types --}}
                                    @foreach ($unitTypes as $unitType)

                                    @php
                                    $typeName = $unitType->propertyType?->name;

                                    if (
                                    $unitType->bedrooms_from !== null &&
                                    $unitType->bedrooms_to !== null
                                    ) {
                                    $bedroomLabel =
                                    $unitType->bedrooms_from == $unitType->bedrooms_to
                                    ? $unitType->bedrooms_from . ' BR'
                                    : $unitType->bedrooms_from . ' - ' . $unitType->bedrooms_to . ' BR';
                                    } elseif ($unitType->bedrooms_from !== null) {
                                    $bedroomLabel = $unitType->bedrooms_from . ' BR';
                                    } else {
                                    $bedroomLabel = null;
                                    }
                                    @endphp


                                    @if ($typeName || $bedroomLabel)

                                    <div class="avanor-property-fact-card">

                                        <span class="avanor-property-fact-label">
                                            Unit Type
                                        </span>

                                        <h3 class="avanor-property-fact-value">

                                            @if ($bedroomLabel)
                                            {{ $bedroomLabel }}
                                            @endif

                                            @if ($typeName)
                                            {{ $typeName }}
                                            @endif

                                        </h3>

                                    </div>

                                    @endif

                                    @endforeach



                                    {{-- Handover --}}
                                    @if (
                                    filled($property->handover_quarter) ||
                                    filled($property->handover_year)
                                    )

                                    <div class="avanor-property-fact-card">

                                        <span class="avanor-property-fact-label">
                                            Handover Date
                                        </span>

                                        <h3 class="avanor-property-fact-value">
                                            {{ trim(
                                                    ($property->handover_quarter ?? '') .
                                                    ' ' .
                                                    ($property->handover_year ?? '')
                                                ) }}
                                        </h3>

                                    </div>

                                    @endif



                                    {{-- Payment Plan --}}
                                    @if (filled($property->payment_plan))

                                    <div class="avanor-property-fact-card">

                                        <span class="avanor-property-fact-label">
                                            Payment Plan
                                        </span>

                                        <h3 class="avanor-property-fact-value">
                                            {{ $property->payment_plan }}
                                        </h3>

                                    </div>

                                    @endif


                                </div>

                            </section>

                            @endif

                        </div>

                    </div>

                </div>



                {{-- =====================================================
                REGISTER INTEREST FORM
            ===================================================== --}}
                <div class="col-xxl-4 col-lg-5">

                    <aside class="sidebar-area">

                        <div class="widget widget-property-contact">

                            <p class="widget_text">
                                Register Your Interest
                            </p>
                            @if (session('lead_success'))
                            <div class="alert alert-success mb-3">
                                {{ session('lead_success') }}
                            </div>
                            @endif

                            @if ($errors->any())
                            <div class="alert alert-danger mb-3">
                                {{ $errors->first() }}
                            </div>
                            @endif
                            <form
                                action="{{ route('leads.store') }}"
                                method="POST"
                                class="widget-property-contact-form">

                                @csrf

                                <input
                                    type="hidden"
                                    name="property_id"
                                    value="{{ $property->id }}">

                                <input
                                    type="hidden"
                                    name="developer_id"
                                    value="{{ $property->developer_id }}">

                                <input
                                    type="hidden"
                                    name="source"
                                    value="property_form">

                                <input
                                    type="hidden"
                                    name="page_url"
                                    value="{{ url()->current() }}">

                                <div class="form-group">
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control style-border"
                                        placeholder="FULL NAME"
                                        value="{{ old('name') }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control style-border"
                                        placeholder="EMAIL ADDRESS"
                                        value="{{ old('email') }}">
                                </div>

                                <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control style-border"
                                        placeholder="PREFERRED BUDGET (E.G AED 2M - 5M)">
                                </div>

                                <div class="form-group style-border3 col-md-12">
                                    <input
                                        type="tel"
                                        id="contact_phone"
                                        name="phone"
                                        class="form-control"
                                        placeholder="Phone Number*"
                                        value="{{ old('phone') }}"
                                        required>
                                </div>

                                <button
                                    type="submit"
                                    class="th-btn style-white th-btn-icon mt-15 avanor-register-btn">
                                    REGISTER YOUR INTEREST
                                </button>

                            </form>

                        </div>

                    </aside>

                </div>








                {{-- =====================================================
                CONTENT AREA
            ===================================================== --}}

                @if (
                $activeSections->isNotEmpty() ||
                $hasProjectDescription ||
                $galleryImages->isNotEmpty() ||
                $amenities->isNotEmpty() ||
                filled($property->map_url)
                )

                <div class="col-xxl-12">

                    <div class="overflow-hidden space" id="about-sec">

                        <div class="containe custom-containerr">

                            <div class="about-page-wrap">

                                <div class="row gy-40 property-detail-row justify-content-between align-items-center">

                                    {{-- =====================================
                                 DYNAMIC CONTENT SECTIONS
                                    ===================================== --}}
                                    @foreach ($activeSections as $section)

                                    @php
                                    $sectionImage = $section->getFirstMedia('section_image');

                                    $sectionImageUrl = $sectionImage
                                    ? \App\Support\MediaUrl::fromMedia(
                                    $sectionImage,
                                    'section_image_avif'
                                    )
                                    : null;
                                    @endphp


                                    {{-- IMAGE LEFT / TEXT RIGHT --}}
                                    @if ($section->layout === 'image_left')

                                    @if ($sectionImageUrl)

                                    <div class="col-lg-6">

                                        <div class="img-box3">

                                            <div class="img1">

                                                <img
                                                    src="{{ $sectionImageUrl }}"
                                                    alt="{{ $section->title ?: $property->title }}"
                                                    loading="lazy"
                                                    decoding="async">

                                            </div>

                                        </div>

                                    </div>

                                    @endif


                                    @if (filled($section->title) || filled($section->content))

                                    <div class="{{ $sectionImageUrl ? 'col-lg-6' : 'col-lg-12' }}">

                                        <div class="title-area mb-0">

                                            @if (filled($section->title))

                                            <div>
                                                <span class="sub-title-dark">
                                                    {{ $section->title }}
                                                </span>
                                            </div>

                                            @endif


                                            @if (filled($section->content))

                                            <div class="text-theme">
                                                {!! $section->content !!}
                                            </div>

                                            @endif

                                        </div>

                                    </div>

                                    @endif



                                    {{-- TEXT LEFT / IMAGE RIGHT --}}
                                    @elseif ($section->layout === 'image_right')

                                    @if (filled($section->title) || filled($section->content))

                                    <div class="{{ $sectionImageUrl ? 'col-lg-6' : 'col-lg-12' }}">

                                        <div class="title-area mb-0">

                                            @if (filled($section->title))

                                            <div>
                                                <span class="sub-title-dark">
                                                    {{ $section->title }}
                                                </span>
                                            </div>

                                            @endif


                                            @if (filled($section->content))

                                            <div class="text-theme">
                                                {!! $section->content !!}
                                            </div>

                                            @endif

                                        </div>

                                    </div>

                                    @endif


                                    @if ($sectionImageUrl)

                                    <div class="col-lg-6">

                                        <div class="img-box3">

                                            <div class="img1">

                                                <img
                                                    src="{{ $sectionImageUrl }}"
                                                    alt="{{ $section->title ?: $property->title }}"
                                                    loading="lazy"
                                                    decoding="async">

                                            </div>

                                        </div>

                                    </div>

                                    @endif



                                    {{-- FULL WIDTH --}}
                                    @elseif ($section->layout === 'full_width')

                                    @if (filled($section->title) || filled($section->content))

                                    <div class="col-lg-12">

                                        <div class="title-area mb-0">

                                            @if (filled($section->title))

                                            <div>
                                                <span class="sub-title-dark project-about-heading">
                                                    {{ $section->title }}
                                                </span>
                                            </div>

                                            @endif


                                            @if (filled($section->content))

                                            <div class="text-theme">
                                                {!! $section->content !!}
                                            </div>

                                            @endif

                                        </div>

                                    </div>

                                    @endif

                                    @endif

                                    @endforeach




                                    <div class="landing-plan-container space">

                                        <div class="landing-plan-heading">

                                            <span class="landing-plan-eyebrow">
                                                PROJECT PLANS
                                            </span>

                                            <h2>
                                                MASTER PLAN & UNIT LAYOUTS
                                            </h2>

                                            <p>
                                                Request detailed project layouts and unit plans for
                                                {{ $property->title }}.
                                            </p>

                                        </div>


                                        <div class="landing-plan-grid">

                                            {{-- MASTER PLAN --}}
                                            <article class="landing-plan-card">

                                                <button
                                                    type="button"
                                                    class="landing-plan-image-wrap"
                                                    data-lead-popup-open
                                                    data-request-type="master_plan">

                                                    <img
                                                        src="{{ asset('assets/img/landing/masterplan.webp') }}"
                                                        alt="The Heights Master Plan"
                                                        class="landing-plan-image">

                                                    <span class="landing-plan-overlay"></span>

                                                    <span class="landing-plan-overlay-text">
                                                        REQUEST MASTER PLAN
                                                    </span>

                                                </button>

                                                <div class="landing-plan-card-footer">

                                                    <h3>
                                                        Master Plan Layout
                                                    </h3>

                                                    <p>
                                                        Explore the complete community layout,
                                                        connectivity and key destinations.
                                                    </p>

                                                    <button
                                                        type="button"
                                                        class="landing-plan-button"
                                                        data-lead-popup-open
                                                        data-request-type="master_plan">
                                                        REQUEST MASTER PLAN
                                                    </button>

                                                </div>

                                            </article>


                                            {{-- UNIT PLAN --}}
                                            <article class="landing-plan-card">

                                                <button
                                                    type="button"
                                                    class="landing-plan-image-wrap"
                                                    data-lead-popup-open
                                                    data-request-type="unit_plan">

                                                    <img
                                                        src="{{ asset('assets/img/landing/fp1.webp') }}"
                                                        alt="The Heights Unit Plan"
                                                        class="landing-plan-image">

                                                    <span class="landing-plan-overlay"></span>

                                                    <span class="landing-plan-overlay-text">
                                                        REQUEST UNIT PLAN
                                                    </span>

                                                </button>

                                                <div class="landing-plan-card-footer">

                                                    <h3>
                                                        Unit Plan Layout
                                                    </h3>

                                                    <p>
                                                        Request detailed layouts for available
                                                        villas and residential configurations.
                                                    </p>

                                                    <button
                                                        type="button"
                                                        class="landing-plan-button"
                                                        data-lead-popup-open
                                                        data-request-type="unit_plan">
                                                        REQUEST UNIT PLAN
                                                    </button>

                                                </div>

                                            </article>

                                        </div>

                                    </div>



                                    {{-- =====================================
                                        ABOUT PROJECT
                                    ===================================== --}}
                                    @if ($hasProjectDescription)

                                    <div class="col-lg-12">

                                        <div class="title-area mb-0">

                                            <div>

                                                <span class="sub-title-dark project-about-heading">
                                                    ABOUT PROJECT
                                                </span>

                                            </div>

                                            <div class="text-theme">
                                                {!! $property->project->description !!}
                                            </div>

                                        </div>

                                    </div>

                                    @endif



                                    {{-- =====================================
                                     GALLERY
                                            ===================================== --}}
                                    @if ($galleryImages->isNotEmpty())

                                    <div class="col-lg-12" id="gallery">

                                        <div class="title-area mb-0">

                                            <div>
                                                <span class="sub-title-dark project-about-heading">
                                                    GALLERY
                                                </span>
                                            </div>

                                            <div class="slider-area property-slider1">

                                                {{-- MAIN GALLERY --}}
                                                <div
                                                    class="swiper th-slider mb-4"
                                                    id="propertySlider"
                                                    data-slider-options='{ "effect":"fade","loop":true,"thumbs":{"swiper":".property-thumb-slider" },"autoplayDisableOnInteraction":"true"}'>

                                                    <div class="swiper-wrapper">

                                                        @foreach ($galleryImages as $image)

                                                        <div class="swiper-slide">

                                                            <div class="property-slider-img gallery-swiper">

                                                                <img
                                                                    src="{{ \App\Support\MediaUrl::fromMedia(
                                            $image,
                                            'gallery_avif'
                                        ) }}"
                                                                    alt="{{ $property->title }}"
                                                                    loading="lazy"
                                                                    decoding="async">

                                                            </div>

                                                        </div>

                                                        @endforeach

                                                    </div>

                                                </div>


                                                {{-- THUMBNAILS --}}
                                                @if ($galleryImages->count() > 1)

                                                <div
                                                    class="swiper th-slider property-thumb-slider "
                                                    data-slider-options='{
                            "effect":"slide",
                            "loop":true,
                            "breakpoints":{
                                "0":{
                                    "slidesPerView":2
                                },
                                "576":{
                                    "slidesPerView":2
                                },
                                "768":{
                                    "slidesPerView":3
                                },
                                "992":{
                                    "slidesPerView":3
                                },
                                "1200":{
                                    "slidesPerView":4
                                }
                            },
                            "autoplayDisableOnInteraction":"true"
                        }'>

                                                    <div class="swiper-wrapper">

                                                        @foreach ($galleryImages as $image)

                                                        <div class="swiper-slide">

                                                            <div class="property-slider-img gallery-swiper-thumbnail">

                                                                <img
                                                                    src="{{ \App\Support\MediaUrl::fromMedia( $image, 'gallery_avif' ) }}"
                                                                    alt="{{ $property->title }}"
                                                                    loading="lazy"
                                                                    decoding="async">

                                                            </div>

                                                        </div>

                                                        @endforeach

                                                    </div>

                                                </div>


                                                <button
                                                    data-slider-prev="#propertySlider"
                                                    class="slider-arrow style3 slider-prev">
                                                    <i class="far fa-chevron-left"></i>
                                                </button>


                                                <button
                                                    data-slider-next="#propertySlider"
                                                    class="slider-arrow style3 slider-next">
                                                    <i class="far fa-chevron-right"></i>
                                                </button>

                                                @endif

                                            </div>

                                        </div>
                                        <div class="landing-section-cta">


                                            <button
                                                type="button"
                                                class="landing-plan-button"
                                                data-lead-popup-open
                                                data-request-type="gallery">
                                                DOWNLOAD GALLERY
                                            </button>

                                        </div>
                                    </div>

                                    @endif



                                    {{-- =====================================
                                        AMENITIES
                                    ===================================== --}}
                                    @if ($amenities->isNotEmpty())

                                    <div class="col-lg-12">

                                        <div class="title-area mb-0">

                                            <div>

                                                <span class="sub-title-dark project-about-heading">
                                                    Amenities
                                                </span>

                                            </div>


                                            <div class="row gy-3">

                                                @foreach ($amenities as $amenity)

                                                <div class="col-xxl-3 col-sm-6">

                                                    <div class="checklist">

                                                        <ul>
                                                            <li>
                                                                <i class="{{ $amenity->icon ?: 'far fa-square-check' }}"></i>
                                                                {{ $amenity->name }}
                                                            </li>
                                                        </ul>

                                                    </div>

                                                </div>

                                                @endforeach

                                            </div>

                                        </div>

                                    </div>

                                    @endif



                                    {{-- =====================================
                                        LOCATION
                                    ===================================== --}}
                                    @if (filled($property->map_url))

                                    <div class="col-lg-12 minus-text-area">

                                        <div class="title-area mb-0">

                                            <div>

                                                <span class="sub-title-dark project-about-heading">
                                                    LOCATION
                                                </span>

                                            </div>


                                            <div class="location-map">

                                                <div class="contact-map">

                                                    <iframe
                                                        src="{{ $property->map_url }}"
                                                        allowfullscreen
                                                        loading="lazy"
                                                        referrerpolicy="no-referrer-when-downgrade"></iframe>

                                                </div>

                                            </div>

                                            <div class="landing-section-cta">


                                                <button
                                                    type="button"
                                                    class="landing-plan-button"
                                                    data-lead-popup-open
                                                    data-request-type="location-details">
                                                    GET LOCATION DETAILS
                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                    @endif


                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                @endif


            </div>

        </div>

    </section>





    <section class="wellness-section">

        <div class="wellness-wrap">

            {{-- LEFT --}}
            <div class="wellness-copy">

                <div class="wellness-eyebrow">
                    DESTINATION DESIGNED FOR WELLNESS AND BELONGING
                </div>

                <h2>
                    THE HEIGHTS<br>
                    COUNTRY CLUB<br>
                    AND WELLNESS
                </h2>

                <p>
                    Envisioned as an exclusive retreat lifestyle, where green
                    landscapes come together to form a vibrant and sustainable
                    community. Inspired by nature-led living, the masterplan
                    weaves meandering pathways, lush green spaces, tranquil
                    courtyards, and cascading water features into a harmonious
                    environment.
                </p>



                <ul class="landing-lifestyle-features">
                    <li>
                        <span class="landing-feature-icon">
                            <i class="far fa-spa"></i>
                        </span>
                        <span>Wellness Centre</span>
                    </li>

                    <li>
                        <span class="landing-feature-icon">
                            <i class="far fa-leaf"></i>
                        </span>
                        <span>Meditation Garden</span>
                    </li>

                    <li>
                        <span class="landing-feature-icon">
                            <i class="far fa-water"></i>
                        </span>
                        <span>Wellness Lake & Promenade</span>
                    </li>

                    <li>
                        <span class="landing-feature-icon">
                            <i class="far fa-umbrella-beach"></i>
                        </span>
                        <span>Private Beach</span>
                    </li>

                    <li>
                        <span class="landing-feature-icon">
                            <i class="far fa-dumbbell"></i>
                        </span>
                        <span>Fitness Area</span>
                    </li>

                    <li>
                        <span class="landing-feature-icon">
                            <i class="far fa-water-ladder"></i>
                        </span>
                        <span>Yoga Lake</span>
                    </li>

                    <li>
                        <span class="landing-feature-icon">
                            <i class="far fa-users"></i>
                        </span>
                        <span>Social Terrace</span>
                    </li>
                </ul>

                <a href="#register-interest" class="wellness-btn" data-lead-popup-open>
                    GET PAYMENT PLAN
                </a>

            </div>


            {{-- CENTER TOP --}}
            <div class="wellness-item wellness-main">
                <img src="{{ asset('assets/img/property/heightswellness1.avif') }}" alt="">
                <div class="wellness-caption">WELLNESS CENTRE</div>
            </div>


            {{-- RIGHT TOP --}}
            <div class="wellness-right-top">

                <div class="wellness-item">
                    <img src="{{ asset('assets/img/property/heightswellness2.avif') }}" alt="">
                    <div class="wellness-caption">FITNESS AREA</div>
                </div>

                <div class="wellness-item">
                    <img src="{{ asset('assets/img/property/heightswellness3.avif') }}" alt="">
                    <div class="wellness-caption">YOGA LAKE</div>
                </div>

            </div>


            {{-- BOTTOM CENTER --}}
            <div class="wellness-item wellness-bottom-center">
                <img src="{{ asset('assets/img/property/heightswellness5.avif') }}" alt="">
                <div class="wellness-caption">PRIVATE BEACH</div>
            </div>


            {{-- BOTTOM RIGHT --}}
            <div class="wellness-item wellness-bottom-right">
                <img src="{{ asset('assets/img/property/heightswellness4.avif') }}" alt="">
                <div class="wellness-caption">MEDITATION GARDEN</div>
            </div>

        </div>

    </section>


    <div
        class="landing-lead-popup"
        id="landingLeadPopup"
        aria-hidden="true">

        <div
            class="landing-lead-popup-backdrop"
            data-lead-popup-close>
        </div>

        <div
            class="landing-lead-popup-dialog"
            role="dialog"
            aria-modal="true"
            aria-label="Register Your Interest">

            <button
                type="button"
                class="landing-lead-popup-close"
                data-lead-popup-close
                aria-label="Close">
                ×
            </button>

            @include('partials.lead-form', [
            'formId' => 'landing-popup-form',
            'heading' => 'Register Your Interest',
            'description' => 'Share your details and our property advisor will contact you with pricing, availability and project information.',
            'buttonText' => 'Submit Enquiry',
            'source' => 'the_heights_popup',
            'propertyId' => $property->id,
            'developerId' => $property->developer_id,
            'action' => route('landing.leads.store'),
            ])

        </div>

    </div>


    <footer
        id="landingFooter"
        class="landing-enquiry-footer">

        <div class="landing-enquiry-container">

            <div class="landing-enquiry-heading">
                <span>PRIVATE ENQUIRY</span>

                <h2>
                    Register Your Interest
                </h2>

                <p>
                    Speak with our property advisor and receive complete details,
                    availability and pricing for {{ $property->title }}.
                </p>
            </div>


            {{-- Success --}}
            @if (session('lead_success'))
            <div class="landing-enquiry-alert landing-enquiry-alert-success">
                {{ session('lead_success') }}
            </div>
            @endif


            {{-- Validation --}}
            @if ($errors->any())
            <div class="landing-enquiry-alert landing-enquiry-alert-error">
                {{ $errors->first() }}
            </div>
            @endif


            <form
                action="{{ route('leads.store') }}"
                method="POST"
                class="landing-enquiry-form">

                @csrf


                {{-- Existing LeadController fields --}}

                <input
                    type="hidden"
                    name="property_id"
                    value="{{ $property->id }}">

                <input
                    type="hidden"
                    name="developer_id"
                    value="{{ $property->developer_id }}">

                <input
                    type="hidden"
                    name="source"
                    value="the_heights_landing_page">


                {{-- Preserve campaign tracking --}}
                <input
                    type="hidden"
                    name="utm_source"
                    value="{{ request('utm_source') }}">

                <input
                    type="hidden"
                    name="utm_medium"
                    value="{{ request('utm_medium') }}">

                <input
                    type="hidden"
                    name="utm_campaign"
                    value="{{ request('utm_campaign') }}">

                <input
                    type="hidden"
                    name="utm_content"
                    value="{{ request('utm_content') }}">


                <div class="landing-enquiry-fields">

                    {{-- Name --}}
                    <div class="landing-enquiry-field">

                        <label for="footer_name">
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="footer_name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter your full name"
                            autocomplete="name"
                            required>

                    </div>


                    {{-- Phone --}}
                    <div class="landing-enquiry-field">

                        <label for="footer_phone">
                            Phone Number
                        </label>

                        <input
                            type="tel"
                            id="footer_phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="+971 50 123 4567"
                            autocomplete="tel"
                            required>

                    </div>


                    {{-- Email --}}
                    <div class="landing-enquiry-field">

                        <label for="footer_email">
                            Email Address
                        </label>

                        <input
                            type="email"
                            id="footer_email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            autocomplete="email">

                    </div>


                    {{-- Submit --}}
                    <div class="landing-enquiry-submit">

                        <button type="submit">
                            ENQUIRE NOW

                            <span aria-hidden="true">
                                →
                            </span>
                        </button>

                    </div>

                </div>


                {{-- Consent --}}
                <label class="landing-enquiry-consent">

                    <input
                        type="checkbox"
                        required>

                    <span class="landing-enquiry-checkbox"></span>

                    <span>
                        I consent to being contacted regarding this property
                        enquiry and agree to the
                        <a href="/privacy-policy" target="_blank">
                            Privacy Policy
                        </a>
                        and
                        <a href="/terms-and-conditions" target="_blank">
                            Terms & Conditions
                        </a>.
                    </span>

                </label>

            </form>

        </div>

    </footer>

    <!-- Legacy Template Scripts -->
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}" defer></script>

    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/main.js') }}" defer></script>
</main>

@endsection