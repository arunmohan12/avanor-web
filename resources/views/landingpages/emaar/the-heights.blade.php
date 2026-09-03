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


@section('robots', 'index,follow')


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

            <div class="landing-header-brand">

                <div class="landing-project-brand">
                    THE HEIGHTS COUNTRY
                    <br>
                    CLUB &amp; WELLNESS
                </div>

                <span class="landing-brand-divider"></span>

                {{-- Existing Avanor logo --}}

                <a href="#home" class="landing-logo">
                    <img
                        src="{{ asset('assets/img/Avanor-lp.png') }}"
                        alt="Avanor">
                </a>


            </div>

            {{-- <a href="#home" class="landing-logo">--}}
            {{-- <img--}}
            {{-- src="{{ asset('assets/img/Avanor-lp.png') }}"--}}
            {{-- alt="Avanor">--}}
            {{-- </a>--}}
            <nav class="landing-nav">


                <a href="#about">
                    Property Details
                </a>

                <a href="#downloads">
                    Downloads
                </a>

                <a href="#gallery">
                    Gallery
                </a>

                <a href="#location">
                    Location
                </a>
                <a href="#" data-lead-popup-open >contact</a>
            </nav>
            <div class="landing-header-actions">


                <a
                    href="https://wa.me/971589798257"
                    class="landing-header-whatsapp whatsapp-track"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="WhatsApp">

                    <img
                        src="{{ asset('assets/img/whatsapp.svg') }}"
                        alt="WhatsApp">

                </a>
                <a
                    href="#"
                    class="landing-header-btn " data-lead-popup-open>
                    GET LATEST PRICES
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

                <a href="#about">
                    Property Details
                </a>





                <a href="#location">Location</a>

                <a href="#downloads">
                    Downloads
                </a>

                <a href="#gallery">
                    Gallery
                </a>

                <a href="#" data-lead-popup-open >contact</a>

                <a
                    href="#"
                    class="landing-mobile-contact " data-lead-popup-open>
                    GET LATEST PRICES


                </a>

            </nav>

        </div>

        </div>
    </header>

    <main>

        @if ($coverMedia)

            <section class="avanor-property-hero" id="home">

                <div class="avanor-property-hero-single">

                    <img
                        src="{{ \App\Support\MediaUrl::fromMedia(
                $coverMedia,
                'cover_avif'
            ) }}"

                        srcset="
                {{ \App\Support\MediaUrl::fromMedia($coverMedia, 'cover_mobile_avif') }} 768w,
                {{ \App\Support\MediaUrl::fromMedia($coverMedia, 'cover_tablet_avif') }} 1280w,
                {{ \App\Support\MediaUrl::fromMedia($coverMedia, 'cover_avif') }} 1920w
            "

                        sizes="100vw"

                        alt="{{ $property->project?->name ?? $property->title }}"

                        class="avanor-property-hero-image"

                        fetchpriority="high"
                        decoding="async">

                    {{-- DARK OVERLAY --}}
                    <div class="avanor-property-hero-overlay"></div>


                    {{-- HERO CONTENT --}}
                    <div class="avanor-property-slide-content-landing">

                <span class="avanor-property-slide-eyebrow">
                    EMAAR PROPERTIES
                </span>

                        <h1 class="avanor-property-slide-title">
                            {{ $property->title }} - New Launch Villas for Sale in Dubai
                        </h1>

                        <p class="avanor-property-slide-description">
                            Luxury 3, 4 & 5 Bedroom Villas at The Heights Country Club & Wellness by Emaar. Explore latest prices, payment plans, floor plans and available units.

                        </p>


                        @if ($property->project?->starting_price)

                            <fieldset class="landing-hero-offer-card">

                                <legend class="landing-hero-offer-label">
                                    3, 4 &amp; 5 BED STANDALONE VILLAS
                                </legend>


                                <div class="landing-hero-offer-details">

                                    {{-- Starting Price --}}
                                    <div class="landing-hero-offer-price">

                            <span>
                                STARTING FROM
                            </span>

                                        <strong>
                                            {{ \App\Support\PriceFormatter::aed(
                                                                        $property->project->starting_price
                                                                    ) }}
                                        </strong>

                                    </div>


                                    {{-- Separator --}}
                                    <span class="landing-hero-offer-divider"></span>


                                    {{-- Payment Plan --}}
                                    <div class="landing-hero-offer-payment">
                            <span>
                                PAYMENT PLAN
                            </span>
                                        <strong>
                                            80/20
                                        </strong>



                                    </div>

                                </div>


                                {{-- CTA BUTTONS --}}
                                <div class="landing-hero-offer-actions">

                                    <a
                                        href="https://wa.me/971589798257"
                                        class="landing-hero-offer-btn whatsapp-track">

                                        <span>WHATSAPP</span>

                                        <x-landing-icon name="whatsapp" />

                                    </a>


                                    <a
                                        href="tel:+971589798257"
                                        class="landing-hero-offer-btn call-track">

                                        <span>CALL</span>

                                        <x-landing-icon name="phone" />

                                    </a>

                                </div>

                            </fieldset>

                        @endif

                    </div>

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


        <section class="landing-about-v2" id="about">

            <div class="landing-gallery-container">

                <div class="landing-about-v2-layout">


                    {{-- =====================================================
                                    ABOUT CONTENT
                                ===================================================== --}}

                    <div class="landing-about-v2-content">

                    <span class="landing-about-v2-eyebrow">
                        DISCOVER THE COMMUNITY
                    </span>

                        <h2 class="landing-about-v2-title">
                            About {{ $property->title }}
                        </h2>

                        <span class="landing-about-v2-line"></span>






                        @if (filled($property->description))
                            <p class="landing-about-v2-description">
                                {!! $property->description !!}
                            </p>
                        @endif

                        {{-- PRICE + HANDOVER --}}
                        <div class="landing-about-v2-property-info">

                            <div class="landing-about-v2-info-card">

                                <div class="landing-about-v2-info-icon">

                                    <svg viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.5">

                                        <path d="M3 7h15a2 2 0 0 1 2 2v10H5a2 2 0 0 1-2-2V7Z" />
                                        <path d="M3 7l3-3h11" />
                                        <path d="M16 12h6v4h-6a2 2 0 0 1 0-4Z" />

                                    </svg>

                                </div>

                                <div>

                                <span>
                                    PROPERTY PRICE
                                </span>

                                    <strong>
                                        {{ \App\Support\PriceFormatter::aed(
                                                        $property->project->starting_price
                                                    ) }}
                                    </strong>

                                </div>

                            </div>


                            <div class="landing-about-v2-info-card">

                                <div class="landing-about-v2-info-icon">

                                    <svg viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.5">

                                        <rect x="3" y="5" width="18" height="16" rx="1" />
                                        <path d="M7 3v4M17 3v4M3 10h18" />
                                        <path d="M8 14h2M14 14h2M8 18h2M14 18h2" />

                                    </svg>

                                </div>

                                <div>

                                <span>
                                    HANDOVER DATE
                                </span>

                                    <strong>
                                        Q3 2029
                                    </strong>

                                </div>

                            </div>

                        </div>

                        {{-- =====================================================
         PRIME CONNECTIVITY / PROJECT HIGHLIGHTS
     ===================================================== --}}

                        <div class="landing-reach">

                            {{-- Heading --}}
                            <div class="landing-reach__heading">

        <span class="landing-reach__eyebrow">
            WHY THE HEIGHTS
        </span>

                                <h3 class="landing-reach__title">
                                    A Community Designed Around You
                                </h3>

                            </div>


                            {{-- =====================================================
                                6 PROJECT HIGHLIGHTS
                            ===================================================== --}}

                            <div class="landing-reach__features">


                                {{-- 1 --}}
                                <div class="landing-reach__feature">

                                    <div class="landing-reach__feature-icon">
                                        <x-landing-icon name="masterplan" />
                                    </div>

                                    <h4>
                                        AED 55 Billion Masterplan
                                    </h4>

                                    <p>
                                        A landmark 81 million sq. ft. Emaar community shaped
                                        around wellness, nature and refined living.
                                    </p>

                                </div>


                                {{-- 2 --}}
                                <div class="landing-reach__feature">

                                    <div class="landing-reach__feature-icon">
                                        <x-landing-icon name="beach" />
                                    </div>

                                    <h4>
                                        Private Beach &amp; Country Club Lifestyle
                                    </h4>

                                    <p>
                                        Exclusive wellness, leisure, fitness and social
                                        amenities within the community.
                                    </p>

                                </div>


                                {{-- 3 --}}
                                <div class="landing-reach__feature">

                                    <div class="landing-reach__feature-icon">
                                        <x-landing-icon name="home" />
                                    </div>

                                    <h4>
                                        3, 4, &amp; 5 Bedroom Luxury Villas
                                    </h4>

                                    <p>
                                        Large plot sizes and contemporary independent villas
                                        designed for premium family living.
                                    </p>

                                </div>


                                {{-- 4 --}}
                                <div class="landing-reach__feature">

                                    <div class="landing-reach__feature-icon">
                                        <x-landing-icon name="garden" />
                                    </div>

                                    <h4>
                                        Nature-First Community
                                    </h4>

                                    <p>
                                        14 million sq. ft. of open space featuring extensive
                                        parks, a beachside clubhouse, landscaped greenways,
                                        lakes, cycling and jogging tracks.
                                    </p>

                                </div>


                                {{-- 5 --}}
                                <div class="landing-reach__feature">

                                    <div class="landing-reach__feature-icon">
                                        <x-landing-icon name="location" />
                                    </div>

                                    <h4>
                                        Prime Dubai Location
                                    </h4>

                                    <p>
                                        Direct access to Al Maktoum International Airport,
                                        Expo City and key destinations across Dubai.
                                    </p>

                                </div>


                                {{-- 6 --}}
                                <div class="landing-reach__feature">

                                    <div class="landing-reach__feature-icon">
                                        <x-landing-icon name="diamond" />
                                    </div>

                                    <h4>
                                        Attractive Price per Sq. Ft.
                                    </h4>

                                    <p>
                                        A highly attractive entry point into a premium
                                        Emaar villa community.
                                    </p>

                                </div>

                            </div>


                            {{-- =====================================================
                                LOCATION BOXES
                            ===================================================== --}}

                            <div class="landing-reach__locations">


                                {{-- Expo --}}
                                <div class="landing-reach__location">

                                    <div class="landing-reach__location-time">
                                        <strong>10</strong>
                                        <span>MINS</span>
                                    </div>

                                    <div class="landing-reach__location-place">


                                        <strong>
                                            Expo City Dubai
                                        </strong>

                                    </div>

                                </div>


                                {{-- Airport --}}
                                <div class="landing-reach__location">

                                    <div class="landing-reach__location-time">
                                        <strong>10</strong>
                                        <span>MINS</span>
                                    </div>

                                    <div class="landing-reach__location-place">


                                        <strong>
                                            Al Maktoum Int’l Airport
                                        </strong>

                                    </div>

                                </div>


                                {{-- Dubai Hills --}}
                                <div class="landing-reach__location">

                                    <div class="landing-reach__location-time">
                                        <strong>20</strong>
                                        <span>MINS</span>
                                    </div>

                                    <div class="landing-reach__location-place">



                                        <strong>
                                            Dubai Hills Estate
                                        </strong>

                                    </div>

                                </div>


                                {{-- Downtown --}}
                                <div class="landing-reach__location">

                                    <div class="landing-reach__location-time">
                                        <strong>30</strong>
                                        <span>MINS</span>
                                    </div>

                                    <div class="landing-reach__location-place">


                                        <strong>
                                            Downtown Dubai
                                        </strong>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =====================================================
                                    REGISTER FORM
                                ===================================================== --}}

                    <aside class="landing-about-v2-form">

                        <div class="landing-about-v2-form-inner">



                            @include('partials.lead-form', [
                            'formId' => 'landing-about-form'
                            ])



                        </div>

                    </aside>

                </div>

            </div>

        </section>





        <section class="landing-about-v2">

            <div class="landing-gallery-container">

                <div class="landing-plan-heading " >

                                                             <span class=" landing-about-v2-eyebrow">
                                                                   THE COLLECTION
                                                                         </span>

                    <h2 class="area-hardcoded landing-about-v2-title">
                        Discover Three Elegant Villa Clusters
                    </h2>
                    <span class="landing-about-v2-line"></span>
                    <p class="landing-about-v2-description">

                    <h3 class="fs-4" >
                        A visionary master community inspired by holistic luxury living, where nature, wellness and thoughtful design come together in perfect harmony at The Heights Country Club & Wellness.
                    </h3>


                </div>

                <div class="row gx-30">


                    @if (
                    $activeSections->isNotEmpty() ||
                    $hasProjectDescription ||
                    $galleryImages->isNotEmpty() ||
                    $amenities->isNotEmpty() ||
                    filled($property->map_url)
                    )

                        <div class="col-xxl-12">

                            <div class="overflow-hidden" id="about-sec">



                                    <div class="about-page-wrap">

                                        <div class="row gy-40 property-detail-row justify-content-between align-items-center landing-collection-desktop">

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
                                                                        alt="{{ $property->project?->name ?? $property->title }}"
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


                                                            <div class="landing-section-cta cta-browse-project">

                                                                <button
                                                                    type="button"
                                                                    class="landing-plan-button"
                                                                    data-lead-popup-open
                                                                    data-request-type="location-details">

                                                                    GET EARLY ACCESS

                                                                </button>

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


                                                            <div class="landing-section-cta cta-browse-project">

                                                                <button
                                                                    type="button"
                                                                    class="landing-plan-button"
                                                                    data-lead-popup-open
                                                                    data-request-type="location-details">

                                                                    GET EARLY ACCESS

                                                                </button>

                                                            </div>

                                                        </div>

                                                    @endif


                                                    @if ($sectionImageUrl)

                                                        <div class="col-lg-6">

                                                            <div class="img-box3">

                                                                <div class="img1">

                                                                    <img
                                                                        src="{{ $sectionImageUrl }}"
                                                                        alt="{{ $property->project?->name ?? $property->title }}"
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

                                        </div>



                                        <div class="landing-collection-mobile">

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

                                                <div class="landing-mobile-collection-item">

                                                    {{-- IMAGE --}}
                                                    @if ($sectionImageUrl)

                                                        <div class="landing-mobile-collection-image">

                                                            <img
                                                                src="{{ $sectionImageUrl }}"
                                                                alt="{{ $property->project?->name ?? $property->title }}"
                                                                loading="lazy"
                                                                decoding="async">

                                                        </div>

                                                    @endif


                                                    {{-- HEADING --}}
                                                    @if (filled($section->title))

                                                        <div class="landing-mobile-collection-heading">

                    <span class="sub-title-dark">
                        {{ $section->title }}
                    </span>

                                                        </div>

                                                    @endif


                                                    {{-- CONTENT --}}
                                                    @if (filled($section->content))

                                                        <div class="landing-mobile-collection-content">
                                                            {!! $section->content !!}
                                                        </div>

                                                    @endif


                                                    {{-- BUTTON --}}
                                                    @if ($section->layout !== 'full_width')

                                                        <div class="landing-mobile-collection-cta">

                                                            <button
                                                                type="button"
                                                                class="landing-plan-button"
                                                                data-lead-popup-open
                                                                data-request-type="location-details">

                                                                GET EARLY ACCESS

                                                            </button>

                                                        </div>

                                                    @endif

                                                </div>

                                            @endforeach

                                        </div>

                                    </div>



                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </section>


            <section class="landing-payment-plan landing-about-v2" id="downloads" >

                <div class="landing-gallery-container">

                    <div class="landing-plan-heading" >

                    <span class="landing-reach__eyebrow">
                        PLANS
                    </span>

                        <h2 class="landing-about-v2-title">
                            FLOOR PLANS
                        </h2>
                        <span class="landing-about-v2-line"></span>
                        <p class="landing-about-v2-description mb-lg">
                            Request detailed project layouts and unit plans for
                            {{ $property->title }}.
                        </p>

                    </div>


                    <div class="landing-plan-grid-br">

                        {{-- MASTER PLAN --}}
                        <article class="landing-plan-card">

                            <button
                                type="button"
                                class="landing-plan-image-wrap"
                                data-lead-popup-open
                                data-request-type="master_plan">

                                <img
                                    src="{{ asset('assets/img/landing/br-plans.webp') }}"
                                    alt=" {{ $property->project?->name ?? $property->title }}"
                                    class="landing-plan-image">

                                <span class="landing-plan-overlay"></span>

                                <span class="landing-plan-overlay-text">
                                SHOW 3BR FlOOR PLAN
                            </span>

                            </button>

                            <div class="landing-plan-card-footer">

                                <h3>
                                    3 Bedroom Villa
                                </h3>

                                <p>
                                    BUA: 3463.07 Sq.ft | Plot: 4,500 Sq.ft

                                </p>



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
                                    src="{{ asset('assets/img/landing/br-plans.webp') }}"
                                    alt=" {{ $property->project?->name ?? $property->title }}"
                                    class="landing-plan-image">

                                <span class="landing-plan-overlay"></span>

                                <span class="landing-plan-overlay-text">
                                SHOW 4BR VILLA FlOOR PLAN
                            </span>

                            </button>

                            <div class="landing-plan-card-footer">

                                <h3>
                                    4 Bedroom Villa
                                </h3>

                                <p>
                                    BUA: 4,312.45 Sq.ft | Plot: 4,500 Sq.ft

                                </p>



                            </div>

                        </article>

                        <article class="landing-plan-card">

                            <button
                                type="button"
                                class="landing-plan-image-wrap"
                                data-lead-popup-open
                                data-request-type="unit_plan">

                                <img
                                    src="{{ asset('assets/img/landing/br-plans.webp') }}"
                                    alt=" {{ $property->project?->name ?? $property->title }}"
                                    class="landing-plan-image">

                                <span class="landing-plan-overlay"></span>

                                <span class="landing-plan-overlay-text">
                                SHOW 5 BR VILLA FlOOR PLAN
                            </span>

                            </button>

                            <div class="landing-plan-card-footer">

                                <h3>
                                    5 Bedroom Villa
                                </h3>

                                <p>
                                    BUA: 5,884.30 Sq.ft | Plot: 5,500 Sq.ft

                                </p>



                            </div>

                        </article>
                    </div>

                </div>
            </section>

        <section class="landing-payment-plan landing-about-v2" id="payment-plan">

            <div class="landing-gallery-container">

                <div class="landing-payment-heading">

                <span class=" landing-about-v2-eyebrow">
                    PAYMENT PLAN
                </span>



                    <h2 class=" landing-about-v2-title">
                        Flexible Payment Plan
                    </h2>
                    <span class="landing-about-v2-line"></span>

                    <p class="landing-about-v2-description mb-lg">
                        Seamless payment plan for a smooth investment journey.
                    </p>

                </div>


                <div class="landing-payment-list">


                    {{-- 01 --}}
                    <div class="landing-payment-item">

                        <span class="landing-payment-dot"></span>

                        <div class="landing-payment-icon">
                            <x-landing-icon name="calendar" />
                        </div>

                        <span class="landing-payment-number">
                        01
                    </span>

                        <div class="landing-payment-content">

                            <strong>
                                1st Installment
                            </strong>

                            <div class="landing-payment-progress">
                                <span class="payment-progress-10"></span>
                            </div>

                        </div>

                        <strong class="landing-payment-percentage">
                            10.00%
                        </strong>

                    </div>


                    {{-- 02 --}}
                    <div class="landing-payment-item">

                        <span class="landing-payment-dot"></span>

                        <div class="landing-payment-icon">
                            <x-landing-icon name="calendar" />
                        </div>

                        <span class="landing-payment-number">
                        02
                    </span>

                        <div class="landing-payment-content">

                            <strong>
                                2nd Installment
                            </strong>

                            <div class="landing-payment-progress">
                                <span class="payment-progress-20"></span>
                            </div>

                        </div>

                        <strong class="landing-payment-percentage">
                            10.00%
                        </strong>

                    </div>


                    {{-- 03 --}}
                    <div class="landing-payment-item">

                        <span class="landing-payment-dot"></span>

                        <div class="landing-payment-icon">
                            <x-landing-icon name="calendar" />
                        </div>

                        <span class="landing-payment-number">
                        03
                    </span>

                        <div class="landing-payment-content">

                            <strong>
                                3rd Installment
                            </strong>

                            <div class="landing-payment-progress">
                                <span class="payment-progress-30"></span>
                            </div>

                        </div>

                        <strong class="landing-payment-percentage">
                            10.00%
                        </strong>

                    </div>


                    {{-- 04 --}}
                    <div class="landing-payment-item">

                        <span class="landing-payment-dot"></span>

                        <div class="landing-payment-icon">
                            <x-landing-icon name="calendar" />
                        </div>

                        <span class="landing-payment-number">
                        04
                    </span>

                        <div class="landing-payment-content">

                            <strong>
                                4th Installment
                            </strong>

                            <div class="landing-payment-progress">
                                <span class="payment-progress-40"></span>
                            </div>

                        </div>

                        <strong class="landing-payment-percentage">
                            10.00%
                        </strong>

                    </div>


                    {{-- 05 --}}
                    <div class="landing-payment-item">

                        <span class="landing-payment-dot"></span>

                        <div class="landing-payment-icon">
                            <x-landing-icon name="calendar" />
                        </div>

                        <span class="landing-payment-number">
                        05
                    </span>

                        <div class="landing-payment-content">

                            <strong>
                                5th Installment
                            </strong>

                            <div class="landing-payment-progress">
                                <span class="payment-progress-50"></span>
                            </div>

                        </div>

                        <strong class="landing-payment-percentage">
                            10.00%
                        </strong>

                    </div>


                    {{-- 06 --}}
                    <div class="landing-payment-item">

                        <span class="landing-payment-dot"></span>

                        <div class="landing-payment-icon">
                            <x-landing-icon name="construction" />
                        </div>

                        <span class="landing-payment-number">
                        06
                    </span>

                        <div class="landing-payment-content">

                            <strong>
                                40% Construction
                            </strong>

                            <div class="landing-payment-progress">
                                <span class="payment-progress-60"></span>
                            </div>

                        </div>

                        <strong class="landing-payment-percentage">
                            10.00%
                        </strong>

                    </div>


                    {{-- 07 --}}
                    <div class="landing-payment-item">

                        <span class="landing-payment-dot"></span>

                        <div class="landing-payment-icon">
                            <x-landing-icon name="construction" />
                        </div>

                        <span class="landing-payment-number">
                        07
                    </span>

                        <div class="landing-payment-content">

                            <strong>
                                60% Construction
                            </strong>

                            <div class="landing-payment-progress">
                                <span class="payment-progress-70"></span>
                            </div>

                        </div>

                        <strong class="landing-payment-percentage">
                            10.00%
                        </strong>

                    </div>


                    {{-- 08 --}}
                    <div class="landing-payment-item">

                        <span class="landing-payment-dot"></span>

                        <div class="landing-payment-icon">
                            <x-landing-icon name="construction" />
                        </div>

                        <span class="landing-payment-number">
                        08
                    </span>

                        <div class="landing-payment-content">

                            <strong>
                                80% Construction
                            </strong>

                            <div class="landing-payment-progress">
                                <span class="payment-progress-80"></span>
                            </div>

                        </div>

                        <strong class="landing-payment-percentage">
                            10.00%
                        </strong>

                    </div>


                    {{-- 09 --}}
                    <div class="landing-payment-item landing-payment-item-final">

                        <span class="landing-payment-dot"></span>

                        <div class="landing-payment-icon">
                            <x-landing-icon name="home" />
                        </div>

                        <span class="landing-payment-number">
                        09
                    </span>

                        <div class="landing-payment-content">

                            <strong>
                                100% Construction &amp; Handover
                            </strong>

                            <div class="landing-payment-progress">
                                <span class="payment-progress-100"></span>
                            </div>

                        </div>

                        <strong class="landing-payment-percentage">
                            20.00%
                        </strong>

                    </div>

                </div>


                {{-- SUMMARY --}}
                <div class="landing-payment-summary">

                <span>
                    <strong>9</strong>
                    Structured Milestones
                </span>

                    <span>
                    <strong>80%</strong>
                    During Construction
                </span>

                    <span>
                    <strong>20%</strong>
                    On Handover
                </span>

                </div>


                {{-- CTA --}}
                <div class="landing-payment-actions">

                    <button
                        type="button"
                        class="landing-payment-btn landing-payment-btn-outline"
                        data-lead-popup-open
                        data-request-type="payment-plan">

                        GET PAYMENT PLAN

                    </button>



                </div>

            </div>

        </section>
        <section class="landing-amenities-v2 landing-about-v2" id="amenities">

            <div class="landing-gallery-container">

                {{-- Heading --}}
                <div class="landing-amenities-v2-heading">

                <span class="  landing-about-v2-eyebrow">
                    AMENITIES
                </span>



                    <h2 class=" landing-about-v2-title">
                        Designed for a life of well-being
                    </h2>
                    <span class="landing-about-v2-line"></span>

                    <p class="landing-about-v2-description mb-lg">
                        From active living to family time, every amenity enhances comfort and convenience.
                    </p>

                </div>


                {{-- Amenities Grid --}}
                <div class="landing-amenities-v2-grid">


                    <div class="landing-amenities-v2-card">

                        <div class="landing-amenities-v2-icon">
                            <x-landing-icon name="beach" />
                        </div>

                        <h3>Beach Clubhouse</h3>

                        <span class="landing-amenities-v2-card-line"></span>

                        <p>
                            An exclusive beachfront clubhouse designed for leisure,
                            relaxation and social experiences.
                        </p>

                    </div>


                    <div class="landing-amenities-v2-card">

                        <div class="landing-amenities-v2-icon">
                            <x-landing-icon name="farm-cafe" />
                        </div>

                        <h3>Farm-to-Table Café</h3>

                        <span class="landing-amenities-v2-card-line"></span>

                        <p>
                            Fresh dining experiences inspired by locally sourced
                            ingredients and healthy living.
                        </p>

                    </div>


                    <div class="landing-amenities-v2-card">

                        <div class="landing-amenities-v2-icon">
                            <x-landing-icon name="hospital" />
                        </div>

                        <h3>Hospital and Clinics</h3>

                        <span class="landing-amenities-v2-card-line"></span>

                        <p>
                            Convenient access to healthcare facilities within
                            the community.
                        </p>

                    </div>


                    <div class="landing-amenities-v2-card">

                        <div class="landing-amenities-v2-icon">
                            <x-landing-icon name="retail" />
                        </div>

                        <h3>Shopping Malls</h3>

                        <span class="landing-amenities-v2-card-line"></span>

                        <p>
                            Everyday shopping and lifestyle conveniences
                            located close to home.
                        </p>

                    </div>


                    <div class="landing-amenities-v2-card">

                        <div class="landing-amenities-v2-icon">
                            <x-landing-icon name="sports-court" />
                        </div>

                        <h3>Sports Courts</h3>

                        <span class="landing-amenities-v2-card-line"></span>

                        <p>
                            Dedicated courts for recreational activities,
                            fitness and active community living.
                        </p>

                    </div>


                    <div class="landing-amenities-v2-card">

                        <div class="landing-amenities-v2-icon">
                            <x-landing-icon name="garden" />
                        </div>

                        <h3>Landscaped Gardens</h3>

                        <span class="landing-amenities-v2-card-line"></span>

                        <p>
                            Beautifully landscaped green spaces for relaxation,
                            walking and outdoor moments.
                        </p>

                    </div>


                    <div class="landing-amenities-v2-card">

                        <div class="landing-amenities-v2-icon">
                            <x-landing-icon name="cycling" />
                        </div>

                        <h3>Cycling Tracks</h3>

                        <span class="landing-amenities-v2-card-line"></span>

                        <p>
                            Dedicated cycling routes designed for an active
                            and healthy lifestyle.
                        </p>

                    </div>


                    <div class="landing-amenities-v2-card">

                        <div class="landing-amenities-v2-icon">
                            <x-landing-icon name="water" />
                        </div>

                        <h3>Lakes &amp; Water Features</h3>

                        <span class="landing-amenities-v2-card-line"></span>

                        <p>
                            Scenic lakes and water features creating a calm
                            and refreshing community environment.
                        </p>

                    </div>

                </div>


                {{-- Bottom Highlights --}}
                <div class="landing-amenities-v2-highlights">


                    <div class="landing-amenities-v2-highlight">

                        <div class="landing-amenities-v2-highlight-icon">
                            <x-landing-icon name="shield" />
                        </div>

                        <div>
                            <strong>SAFE &amp; SECURE</strong>

                            <span>
                            Gated community living
                        </span>
                        </div>

                    </div>


                    <div class="landing-amenities-v2-highlight">

                        <div class="landing-amenities-v2-highlight-icon">
                            <x-landing-icon name="leaf" />
                        </div>

                        <div>
                            <strong>SUSTAINABLE LIVING</strong>

                            <span>
                            Green spaces &amp; wellness
                        </span>
                        </div>

                    </div>


                    <div class="landing-amenities-v2-highlight">

                        <div class="landing-amenities-v2-highlight-icon">
                            <x-landing-icon name="users" />
                        </div>

                        <div>
                            <strong>COMMUNITY LIVING</strong>

                            <span>
                            Spaces that bring people together
                        </span>
                        </div>

                    </div>


                    <div class="landing-amenities-v2-highlight">

                        <div class="landing-amenities-v2-highlight-icon">
                            <x-landing-icon name="star" />
                        </div>

                        <div>
                            <strong>PREMIUM LIFESTYLE</strong>

                            <span>
                            World-class community amenities
                        </span>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="landing-gallery-section landing-about-v2" id="gallery">

            <div class="landing-gallery-container">



                @if ($galleryImages->isNotEmpty())

                    <section class="landing-project-gallery " id="gallery">

                        <div class="landing-project-gallery-heading">

                    <span class="landing-project-gallery-eyebrow">
                        COMMUNITY RENDERS
                    </span>

                            <h2 class="landing-about-v2-title">
                                Project Gallery
                            </h2>

                            <span class="landing-project-gallery-line"></span>

                        </div>


                        <div
                            class="landing-project-gallery-grid"
                            id="landingProjectGallery">

                            @foreach ($galleryImages as $image)

                                @php
                                    $thumbnailUrl = \App\Support\MediaUrl::fromMedia(
                                    $image,
                                    'gallery_tablet_avif'
                                    );

                                    $fullImageUrl = \App\Support\MediaUrl::fromMedia(
                                    $image,
                                    'gallery_avif'
                                    );
                                @endphp

                                <button
                                    type="button"
                                    class="landing-project-gallery-item"
                                    data-gallery-index="{{ $loop->index }}"
                                    data-gallery-src="{{ $fullImageUrl }}"
                                    aria-label="Open gallery image {{ $loop->iteration }}">

                                    <img
                                        src="{{ $thumbnailUrl }}"
                                        srcset="
                            {{ \App\Support\MediaUrl::fromMedia($image, 'gallery_mobile_avif') }} 768w,
                            {{ \App\Support\MediaUrl::fromMedia($image, 'gallery_tablet_avif') }} 1280w
                        "
                                        sizes="
                            (max-width: 767px) 100vw,
                            (max-width: 991px) 50vw,
                            33vw
                        "
                                        alt="{{ $property->project?->name ?? $property->title }} - Gallery image {{ $loop->iteration }}"
                                        loading="lazy"
                                        decoding="async">

                                    <span class="landing-project-gallery-overlay"></span>

                                </button>

                            @endforeach

                        </div>

                    </section>


                    {{-- =====================================================
                                        GALLERY LIGHTBOX
                                    ===================================================== --}}

                    <div
                        class="landing-gallery-lightbox"
                        id="landingGalleryLightbox"
                        role="dialog"
                        aria-modal="true"
                        aria-label="Project gallery"
                        aria-hidden="true">

                        <button
                            type="button"
                            class="landing-gallery-lightbox-close"
                            id="landingGalleryLightboxClose"
                            aria-label="Close gallery">
                            ×
                        </button>


                        @if ($galleryImages->count() > 1)

                            <button
                                type="button"
                                class="landing-gallery-lightbox-arrow landing-gallery-lightbox-prev"
                                id="landingGalleryLightboxPrev"
                                aria-label="Previous image">

                                <x-landing-icon name="chevron-left" />

                            </button>

                        @endif


                        <div class="landing-gallery-lightbox-content">

                            <img
                                src=""
                                alt=""
                                id="landingGalleryLightboxImage">

                            <div
                                class="landing-gallery-lightbox-counter"
                                id="landingGalleryLightboxCounter">
                            </div>

                        </div>


                        @if ($galleryImages->count() > 1)

                            <button
                                type="button"
                                class="landing-gallery-lightbox-arrow landing-gallery-lightbox-next"
                                id="landingGalleryLightboxNext"
                                aria-label="Next image">

                                <x-landing-icon name="chevron-right" />

                            </button>

                        @endif

                    </div>

                @endif


                    <div class="landing-payment-actions">

                        <button
                            type="button"
                            class="landing-payment-btn landing-payment-btn-outline"
                            data-lead-popup-open
                            data-request-type="payment-plan">

                            DOWNLOAD GALLERY

                        </button>



                    </div>

            </div>
        </section>



        {{-- =====================================================
                    FAQ SECTION
                ===================================================== --}}

            <section class="landing-faq-section landing-about-v2" id="location">

                <div class="landing-gallery-container">

                    <div class="row g-5 align-items-stretch">

                        {{-- =====================================================
                            LEFT — FAQ
                        ===================================================== --}}

                        <div class="col-lg-6 d-flex">

                            <div class="landing-faq-intro">

                    <span class="   landing-about-v2-title">
                        FAQ
                    </span>
                                <span class="landing-about-v2-line mb-lg"></span>

                                <details class="landing-faq-item">

                                    <summary>
                            <span>
                                What is The Heights by Emaar?
                            </span>

                                        <span
                                            class="landing-faq-toggle"
                                            aria-hidden="true">
                            </span>
                                    </summary>

                                    <div class="landing-faq-answer">

                                        <p>
                                            The Heights by Emaar is a premium villa
                                            community focused on wellness, nature, and
                                            family living, offering spacious 3, 4 and
                                            5-bedroom villas with world-class amenities.
                                        </p>

                                    </div>

                                </details>


                                <details class="landing-faq-item">

                                    <summary>
                            <span>
                                What is the payment plan for The Heights by Emaar?
                            </span>

                                        <span
                                            class="landing-faq-toggle"
                                            aria-hidden="true">
                            </span>
                                    </summary>

                                    <div class="landing-faq-answer">

                                        <p>
                                            The Heights offers an 80/20 payment plan,
                                            with payments structured throughout
                                            construction and the remaining 20% due
                                            upon handover.
                                        </p>

                                    </div>

                                </details>


                                <details class="landing-faq-item">

                                    <summary>
                            <span>
                                How large is the Emaar Heights community?
                            </span>

                                        <span
                                            class="landing-faq-toggle"
                                            aria-hidden="true">
                            </span>
                                    </summary>

                                    <div class="landing-faq-answer">

                                        <p>
                                            The Heights spans approximately 81 million
                                            sq. ft., featuring expansive green spaces,
                                            parks, wellness facilities, and community
                                            amenities.
                                        </p>

                                    </div>

                                </details>


                                <details class="landing-faq-item">

                                    <summary>
                            <span>
                                Is The Heights by Emaar a good investment?
                            </span>

                                        <span
                                            class="landing-faq-toggle"
                                            aria-hidden="true">
                            </span>
                                    </summary>

                                    <div class="landing-faq-answer">

                                        <p>
                                            The Heights offers strong long-term potential
                                            due to its Emaar brand, strategic location,
                                            premium villas, and wellness-focused community
                                            concept.
                                        </p>

                                    </div>

                                </details>


                                <details class="landing-faq-item">

                                    <summary>
                            <span>
                                When is The Heights expected to be handed over?
                            </span>

                                        <span
                                            class="landing-faq-toggle"
                                            aria-hidden="true">
                            </span>
                                    </summary>

                                    <div class="landing-faq-answer">

                                        <p>
                                            The Heights by Emaar is currently an off-plan
                                            project, with expected handover in 2030.
                                        </p>

                                    </div>

                                </details>

                            </div>

                        </div>


                        {{-- =====================================================
                            RIGHT — LOCATION
                        ===================================================== --}}

                        <div class="col-lg-6 d-flex">

                            <div class="landing-location-map-column">

                    <span class="landing-about-v2-title">
                        LOCATION
                    </span>
                                <span class="landing-about-v2-line mb-lg"></span>


                                <div class="location-map">

                                    <div class="contact-map">

                                        <iframe
                                            src="{{ $property->map_url }}"
                                            title="Map showing The Heights location in Dubai South"
                                            allowfullscreen
                                            loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade">
                                        </iframe>

                                    </div>

                                </div>


                                <div class="landing-location-map-footer">

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
                'heading' => 'GET PROJECT DETAILS',
                'description' => 'Share your details and our property advisor will contact you with pricing, availability and project information.',
                'buttonText' => 'Submit Enquiry',
                'source' => 'the_heights_popup',
                'propertyId' => $property->id,
                'developerId' => $property->developer_id,
                'action' => route('landing.leads.store'),
                ])

            </div>

        </div>


            {{-- =====================================================
        DEVELOPER + COMMUNITY
    ===================================================== --}}
            <section class="landing-developer-community landing-about-v2">

                <div class="landing-gallery-container">

                    <div class="landing-developer-community-grid">

                        {{-- =================@media (max-width: 991px) {
    .landing-about-v2 > .landing-gallery-container {
        width: calc(100% - 40px);
    }
}

@media (max-width: 575px) {
    .landing-about-v2 > .landing-gallery-container {
        width: calc(100% - 32px);
    }
}====================================
                            LEFT — DEVELOPER
                        ===================================================== --}}

                        <div class="landing-developer-panel">

                <span class="  landing-about-v2-eyebrow">
                    ABOUT THE DEVELOPER
                </span>

                            <h2 class=" landing-about-v2-title">
                                Emaar Properties
                            </h2>
                            <span class="landing-about-v2-line"></span>
                            <div class="landing-developer-copy">

                                <p>
                                    Emaar Properties is one of Dubai’s leading real estate
                                    developers, known for creating master-planned communities,
                                    premium residences and landmark destinations across the UAE.
                                </p>

                                <p>
                                    The Heights Country Club &amp; Wellness is an Emaar
                                    development in Dubai focused on wellness-led living,
                                    luxury villas, landscaped green spaces and an exclusive
                                    country club lifestyle.
                                </p>

                            </div>


                            {{-- Developer Highlights --}}
                            <div class="landing-developer-highlights">

                                <div class="landing-developer-highlight">

                                    <div class="landing-developer-highlight-icon">
                                        <x-landing-icon name="home" />
                                    </div>

                                    <strong>Global Leader</strong>

                                    <span>in Real Estate</span>

                                </div>


                                <div class="landing-developer-highlight">

                                    <div class="landing-developer-highlight-icon">
                                        <x-landing-icon name="shield" />
                                    </div>

                                    <strong>Proven</strong>

                                    <span>Track Record</span>

                                </div>


                                <div class="landing-developer-highlight">

                                    <div class="landing-developer-highlight-icon">
                                        <x-landing-icon name="users" />
                                    </div>

                                    <strong>Premium</strong>

                                    <span>Communities</span>

                                </div>


                                <div class="landing-developer-highlight">

                                    <div class="landing-developer-highlight-icon">
                                        <x-landing-icon name="calendar" />
                                    </div>

                                    <strong>40+ Years</strong>

                                    <span>of Excellence</span>

                                </div>

                            </div>

                        </div>


                        {{-- =====================================================
                            RIGHT — COMMUNITY
                        ===================================================== --}}

                        <div class="landing-community-panel">

                            <div class="landing-community-heading">

                                <span class="landing-community-heading-line"></span>

                                <div>

                                    <h3>
                                        THE HEIGHTS COUNTRY CLUB &amp; WELLNESS
                                    </h3>

                                    <span>
                            BY EMAAR
                        </span>

                                </div>

                                <span class="landing-community-heading-line"></span>

                            </div>


                            <div class="landing-community-stats">


                                {{-- 81M --}}
                                <div class="landing-community-stat">

                                    <div class="landing-community-stat-icon">
                                        <x-landing-icon name="masterplan" />
                                    </div>

                                    <strong class="landing-community-stat-value">
                                        81M+
                                    </strong>

                                    <span class="landing-community-stat-rule"></span>

                                    <strong class="landing-community-stat-label">
                                        SQ. FT.
                                    </strong>

                                    <span class="landing-community-stat-description">
                            Total Development
                        </span>

                                </div>


                                {{-- AED 55B --}}
                                <div class="landing-community-stat">

                                    <div class="landing-community-stat-icon">
                                        <x-landing-icon name="coins" />
                                    </div>

                                    <strong class="landing-community-stat-value">
                                        AED 55B+
                                    </strong>

                                    <span class="landing-community-stat-rule"></span>

                                    <strong class="landing-community-stat-label">
                                        DEVELOPMENT VALUE
                                    </strong>

                                    <span class="landing-community-stat-description">
                            Total Project Value
                        </span>

                                </div>


                                {{-- Exclusive --}}
                                <div class="landing-community-stat">

                                    <div class="landing-community-stat-icon">
                                        <x-landing-icon name="diamond" />
                                    </div>

                                    <strong class="landing-community-stat-value">
                                        1
                                    </strong>

                                    <span class="landing-community-stat-rule"></span>

                                    <strong class="landing-community-stat-label">
                                        EXCLUSIVE
                                    </strong>

                                    <span class="landing-community-stat-description">
                            Wellness Community
                        </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>



            {{-- =====================================================
                MAIN FOOTER
            ===================================================== --}}

            <footer
                class="landing-main-footer landing-enquiry-footer landing-about-v2"
                id="landingFooter">

                <div class="landing-gallery-container">


                    <div class="landing-main-footer-grid">


                        {{-- =====================================================
                            COMMUNITY
                        ===================================================== --}}

                        <div class="landing-footer-brand">

                            <img
                                src="{{ asset('assets/img/landing/community-the-heights.png') }}"
                                alt="The Heights Country Club & Wellness"
                                loading="lazy">

                            <p>
                                The Heights Country Club &amp; Wellness by Emaar brings
                                together nature, well-being and premium community living
                                in one of Dubai's most anticipated residential destinations.
                            </p>






                        </div>


                        {{-- =====================================================
                            DISCOVER
                        ===================================================== --}}

                        <div class="landing-footer-column landing-footer-discover">

                            <h3>
                                DISCOVER
                            </h3>

                            <nav>

                                <a href="#about">
                                    About the Community
                                </a>

                                <a href="#amenities">
                                    Amenities
                                </a>

                                <a href="#gallery">
                                    Gallery
                                </a>

                                <a href="#location">
                                    Location
                                </a>

                            </nav>

                        </div>


                        {{-- =====================================================
                            PROPERTY
                        ===================================================== --}}

                        <div class="landing-footer-column landing-footer-property">

                            <h3>
                                PROPERTY
                            </h3>

                            <nav>

                                <a href="#home">
                                    Property Overview
                                </a>

                                <a href="#payment-plan">
                                    Payment Plan
                                </a>

                                <a
                                    href="#"
                                    data-lead-popup-open
                                    data-request-type="floor-plans">
                                    Floor Plans
                                </a>

                                <a
                                    href="#"
                                    data-lead-popup-open
                                    data-request-type="brochure">
                                    Brochure
                                </a>

                            </nav>

                        </div>


                        {{-- =====================================================
                            SUPPORT
                        ===================================================== --}}

                        <div class="landing-footer-column landing-footer-support">

                            <h3>
                                SUPPORT
                            </h3>

                            <nav>

                                <a href="#faq">
                                    FAQs
                                </a>

                                <a data-lead-popup-open href="#contact">
                                    Contact Us
                                </a>

                                <a href="{{ route('landing.privacy-policy') }}">
                                    Privacy Policy
                                </a>

                                <a href="{{ route('landing.terms-and-conditions') }}">
                                    Terms &amp; Conditions
                                </a>

                            </nav>

                        </div>


                        {{-- =====================================================
                            CTA
                        ===================================================== --}}

                        <div class="landing-footer-cta">

                <span>
                    INTERESTED IN THE HEIGHTS?
                </span>

                            <p>
                                Get the latest prices, availability and project details.
                            </p>

                            <button
                                type="button"
                                data-lead-popup-open
                                data-request-type="latest-prices">

                                GET LATEST PRICES

                                <span aria-hidden="true">
                        →
                    </span>

                            </button>

                        </div>

                    </div>


                    {{-- =====================================================
                        DISCLAIMER
                    ===================================================== --}}

                    <div class="landing-footer-disclaimer">

                        <strong>
                            DISCLAIMER
                        </strong>

                        <p>
                            Images, renderings, floor plans, layouts, dimensions,
                            specifications, prices, payment plans and other project
                            information displayed on this website are provided for
                            general information and illustrative purposes only.
                            Information may change without prior notice and should be
                            independently verified before making a purchase decision.
                            Avanor Capital is not the developer of this project.
                        </p>

                    </div>


                    {{-- =====================================================
                        BOTTOM
                    ===================================================== --}}

                    <div class="landing-footer-bottom">

            <span>
                © {{ date('Y') }} Avanor Capital. All Rights Reserved.
            </span>

                        <div>
                            <a href="{{ route('landing.privacy-policy') }}">
                                Privacy Policy
                            </a>

                            <a href="{{ route('landing.terms-and-conditions') }}">
                                Terms &amp; Conditions
                            </a>
                        </div>

                    </div>

                </div>

            </footer>

    </main>

@endsection
