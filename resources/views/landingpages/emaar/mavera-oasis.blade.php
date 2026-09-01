@extends('landingpages.layouts.mavera-landing')


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
                    <a href="#home" class="landing-logo">
                        <img
                            src="{{ asset('assets/img/landing/logoMareva.png') }}"
                            alt="Avanor">
                    </a>
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


                <a href="#property-details">
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
                <a href="#contact">contact</a>
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


                <a href="#location">Location</a>

                <a href="#downloads">
                    Downloads
                </a>

                <a href="#gallery">
                    Gallery
                </a>

                <a href="#contact">contact</a>

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
                            Luxury Villas and Mansions at Mareva, The Oasis by Emaar. Explore latest prices, payment plans, floor plans and available units.
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

                                        <x-landing-icon name="whatsapp"/>

                                    </a>


                                    <a
                                        href="tel:+971589798257"
                                        class="landing-hero-offer-btn call-track">

                                        <span>CALL</span>

                                        <x-landing-icon name="phone"/>

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

        <section class="space ">

            <div class="landing-gallery-container">

                <div class="row gx-30">


                    {{-- =====================================================
                        PROPERTY OVERVIEW
                    ===================================================== --}}
                    <div class="col-xxl-8 col-lg-7" id="property-details">

                        <div class="property-page-single">

                            <div class="page-content">

                                <h2 class="page-title">
                                    ABOUT {{ $property->title }}
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
                                    action="{{ route('landing.leads.store') }}"
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


                    <div class="landing-plan-container space-top" id="downloads">

                        <div class="landing-plan-heading">

                        <span class="landing-plan-eyebrow">
                            BED ROOM PLANS
                        </span>

                            <h2>
                                BED ROOM PLANS & FLOOR LAYOUTS
                            </h2>

                            <p>
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
                                    SHOW 3BR VILLA GROUND FlOOR PLAN
                                </span>

                                </button>

                                <div class="landing-plan-card-footer">

                                    <h3>
                                        3 Bedroom Villa - Ground Floor
                                    </h3>

                                    <p>
                                        BUA: 3,404 Sq.ft | Plot: 4,847 S1.ft

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
                                    SHOW 3BR VILLA UPPER FlOOR PLAN
                                </span>

                                </button>

                                <div class="landing-plan-card-footer">

                                    <h3>
                                        3 Bedroom Villa - Upper Floor
                                    </h3>

                                    <p>
                                        BUA: 3,404 Sq.ft | Plot: 4,847 S1.ft

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
                                    SHOW 4 BR VILLA GROUND FlOOR PLAN
                                </span>

                                </button>

                                <div class="landing-plan-card-footer">

                                    <h3>
                                        4 Bedroom Villa - Ground Floor
                                    </h3>

                                    <p>
                                        BUA: 3,404 Sq.ft | Plot: 4,847 S1.ft

                                    </p>


                                </div>

                            </article>
                        </div>

                    </div>


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

                                        <div
                                            class="row gy-40 property-detail-row justify-content-between align-items-center">

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
                                                                        alt=" {{ $property->project?->name ?? $property->title }}"
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
                                                                        alt=" {{ $property->project?->name ?? $property->title }}"
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


                                            <div class="landing-plan-container space-top" id="about">

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
                                                                alt=" {{ $property->project?->name ?? $property->title }}"
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
                                                                alt=" {{ $property->project?->name ?? $property->title }}"
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

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endif


                </div>

            </div>

        </section>


        <section class="landing-gallery-section " id="gallery">

            <div class="landing-gallery-container">


                @if ($galleryImages->isNotEmpty())

                    <section class="landing-project-gallery " id="gallery">

                        <div class="landing-project-gallery-heading">

                    <span class="landing-project-gallery-eyebrow">
                        COMMUNITY RENDERS
                    </span>

                            <h2>
                                Project <em>Gallery</em>
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

                                <x-landing-icon name="chevron-left"/>

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

                                <x-landing-icon name="chevron-right"/>

                            </button>

                        @endif

                    </div>

                @endif


                <div class="landing-section-ct space-bottom">


                    <button
                        type="button"
                        class="landing-plan-button"
                        data-lead-popup-open
                        data-request-type="gallery">
                        DOWNLOAD GALLERY
                    </button>

                </div>


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

                                    @php
                                        $amenityIcon = match ($amenity->icon) {
                                        'fa-solid fa-child' => 'child',
                                        'fa-solid fa-person-swimming' => 'swimming',
                                        'fa-solid fa-dumbbell' => 'dumbbell',
                                        'fa-solid fa-utensils' => 'utensils',
                                        default => 'check',
                                        };
                                    @endphp

                                    <div class="col-xxl-3 col-sm-6">

                                        <div class="checklist">

                                            <ul>
                                                <li>
                                                    <x-landing-icon :name="$amenityIcon"/>
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

                    <div class="col-lg-12 minus-text-area" id="location">

                        <section class="landing-location-section">

                            <div class="landing-location-grid">

                                {{-- LEFT SIDE --}}
                                <div class="landing-location-content">

                            <span class="sub-title-dark project-about-heading">
                                LOCATION
                            </span>

                                    <h2 class="landing-location-title">
                                        Me'aisem Second , UAE

                                    </h2>


                                    <p class="landing-location-description">
                                        Ideally positioned in Me'aisem Second with convenient access
                                        to major destinations, business districts and lifestyle
                                        landmarks across Dubai.
                                    </p>


                                    <div class="landing-location-list">

                                        <div class="landing-location-item">

                                            <div class="landing-location-time">
                                                <strong>28</strong>
                                                <span>MINS</span>
                                            </div>

                                            <div class="landing-location-destination">
                                                <span>Dubai Marina & Dubai Marina Mall</span>
                                            </div>

                                        </div>


                                        <div class="landing-location-item">

                                            <div class="landing-location-time">
                                                <strong>18</strong>
                                                <span>MINS</span>
                                            </div>

                                            <div class="landing-location-destination">
                                                <span>Al Maktoum Int’l Airport</span>
                                            </div>

                                        </div>


                                        <div class="landing-location-item">

                                            <div class="landing-location-time">
                                                <strong>20</strong>
                                                <span>MINS</span>
                                            </div>

                                            <div class="landing-location-destination">
                                                <span>Dubai Hills Estate</span>
                                            </div>

                                        </div>


                                        <div class="landing-location-item">

                                            <div class="landing-location-time">
                                                <strong>35</strong>
                                                <span>MINS</span>
                                            </div>

                                            <div class="landing-location-destination">
                                                <span>Downtown Dubai</span>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                {{-- RIGHT SIDE --}}
                                <div class="landing-location-map-column">

                                    <div class="location-map">

                                        <div class="contact-map">

                                            <iframe
                                                src="{{ $property->map_url }}"
                                                title="Map showing Mareva At the oasis location "
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

                        </section>

                    </div>

                @endif
            </div>
        </section>


        <section class="wellness-section space-bottom">

            <div class="wellness-wrap">

                {{-- LEFT --}}
                <div class="wellness-copy">

                    <div class="wellness-eyebrow">
                        Modern Waterfront Living Redefined at The Oasis by Emaar
                    </div>

                    <h2>
                        THE OASIS BY<br>

                        EMAAR
                    </h2>

                    <p>
                        Emaar’s latest masterpiece, The Oasis, redefines high-end residential living through a seamless
                        blend of natural beauty and architectural mastery. Set against peaceful canals and vibrant
                        landscapes, this exclusive community features bespoke villas and expansive mansions tailored for
                        the discerning buyer.

                        Every residence prioritizes fluid indoor-outdoor spaces, combining high-end interior craft with
                        resort-style, personalized concierge service. Whether relaxing along the waterfront or taking
                        advantage of the community's private wellness amenities, everyday life here feels like an
                        effortless retreat.

                    </p>


                    <ul class="landing-lifestyle-features">

                        <li>
                        <span class="landing-feature-icon">
                            <x-landing-icon name="spa"/>
                        </span>
                            <span>100 million sq ft
                            Total Land Area</span>
                        </li>

                        <li>
                        <span class="landing-feature-icon">
                            <x-landing-icon name="leaf"/>
                        </span>
                            <span>2600
                            Villas</span>
                        </li>

                        <li>
                        <span class="landing-feature-icon">
                            <x-landing-icon name="water"/>
                        </span>
                            <span>25% of the Land
                                Open Spaces + Amenities
                                    </span>
                        </li>

                        <li>
                        <span class="landing-feature-icon">
                            <x-landing-icon name="beach"/>
                        </span>
                            <span>
                                4 International Golf Courses
                                In Close Proximity</span>
                        </li>





                    </ul>

                    <a href="#register-interest" class="wellness-btn" data-lead-popup-open>
                        GET PAYMENT PLAN
                    </a>

                </div>


                {{-- CENTER TOP --}}
                <div class="wellness-item wellness-main">
                    <img src="{{ asset('assets/img/property/mareva-1.avif') }}"
                         alt=" {{ $property->project?->name ?? $property->title }}">
                    <div class="wellness-caption">Waterfront Living</div>
                </div>


                {{-- RIGHT TOP --}}
                <div class="wellness-right-top">

                    <div class="wellness-item">
                        <img src="{{ asset('assets/img/property/mareva-2.avif') }}"
                             alt=" {{ $property->project?->name ?? $property->title }}">
                        <div class="wellness-caption">Gated Community</div>
                    </div>

                    <div class="wellness-item">
                        <img src="{{ asset('assets/img/property/mareva-3.avif') }}"
                             alt=" {{ $property->project?->name ?? $property->title }}">
                        <div class="wellness-caption">Private Beach</div>
                    </div>

                </div>


                {{-- BOTTOM CENTER --}}
                <div class="wellness-item wellness-bottom-center">
                    <img src="{{ asset('assets/img/property/mareva-4.avif') }}"
                         alt=" {{ $property->project?->name ?? $property->title }}">
                    <div class="wellness-caption">Seamless Indoor-Outdoor Flow</div>
                </div>


                {{-- BOTTOM RIGHT --}}
                <div class="wellness-item wellness-bottom-right">
                    <img src="{{ asset('assets/img/property/mareva-5.avif') }}"
                         alt=" {{ $property->project?->name ?? $property->title }}">
                    <div class="wellness-caption">World-Class Architecture</div>
                </div>

            </div>

        </section>

        {{-- =====================================================
                FAQ SECTION
            ===================================================== --}}

        <section class="landing-faq-section" id="faq">

            <div class="landing-faq-container">

                {{-- Left --}}
                <div class="landing-faq-intro">


                <span class="sub-title-dark project-about-heading">
                    COMMON QUESTIONS
                </span>
                    <h2 class="landing-faq-title">
                        Frequently
                        <em>Asked</em>
                    </h2>


                    <p class="landing-faq-description">
                        Have a question about The Mareva by Emaar?
                        We're here to help.
                    </p>

                    <button
                        type="button"
                        class="landing-faq-contact"
                        data-lead-popup-open>
                        TALK TO AN EXPERT
                    </button>

                </div>


                {{-- Right --}}
                <div class="landing-faq-list">

                    <details class="landing-faq-item">

                        <summary>
            <span>
                What is Mareva at The Oasis by Emaar?
            </span>

                            <span class="landing-faq-toggle" aria-hidden="true"></span>
                        </summary>

                        <div class="landing-faq-answer">
                            <p>
                                Mareva at The Oasis by Emaar is a luxury residential development
                                within The Oasis master community in Dubai. It offers premium
                                villas designed for spacious family living, privacy and a
                                resort-inspired lifestyle surrounded by landscaped green spaces
                                and water features.
                            </p>
                        </div>

                    </details>


                    <details class="landing-faq-item">

                        <summary>
            <span>
                Where is Mareva at The Oasis located in Dubai?
            </span>

                            <span class="landing-faq-toggle" aria-hidden="true"></span>
                        </summary>

                        <div class="landing-faq-answer">
                            <p>
                                Mareva is located within The Oasis by Emaar in Dubai. The
                                community is positioned to provide convenient access to major
                                roads, business districts, lifestyle destinations and key areas
                                across Dubai while maintaining a private residential setting.
                            </p>
                        </div>

                    </details>


                    <details class="landing-faq-item">

                        <summary>
            <span>
                What types of villas are available at Mareva at The Oasis?
            </span>

                            <span class="landing-faq-toggle" aria-hidden="true"></span>
                        </summary>

                        <div class="landing-faq-answer">
                            <p>
                                Mareva at The Oasis features a collection of luxury villas with
                                spacious layouts, contemporary architecture, private outdoor
                                areas and premium finishes. Buyers can contact Avanor Capital
                                for the latest villa configurations, available units and floor
                                plans.
                            </p>
                        </div>

                    </details>


                    <details class="landing-faq-item">

                        <summary>
            <span>
                What is the starting price of villas at Mareva at The Oasis?
            </span>

                            <span class="landing-faq-toggle" aria-hidden="true"></span>
                        </summary>

                        <div class="landing-faq-answer">
                            <p>
                                Villa prices at Mareva at The Oasis vary depending on the
                                property type, size, plot and availability. Contact Avanor
                                Capital for the latest Mareva price list, current availability
                                and booking information directly from the project inventory.
                            </p>
                        </div>

                    </details>


                    <details class="landing-faq-item">

                        <summary>
            <span>
                What is the Mareva at The Oasis payment plan?
            </span>

                            <span class="landing-faq-toggle" aria-hidden="true"></span>
                        </summary>

                        <div class="landing-faq-answer">
                            <p>
                                Mareva at The Oasis offers a structured payment plan designed
                                for off-plan property buyers. Payment schedules may depend on
                                the current release, so buyers should request the latest Emaar
                                payment plan, booking amount and instalment schedule before
                                reserving a villa.
                            </p>
                        </div>

                    </details>


                    <details class="landing-faq-item">

                        <summary>
            <span>
                Are Mareva at The Oasis floor plans available?
            </span>

                            <span class="landing-faq-toggle" aria-hidden="true"></span>
                        </summary>

                        <div class="landing-faq-answer">
                            <p>
                                Yes. Mareva floor plans are available for the different villa
                                layouts released within the project. Contact Avanor Capital to
                                receive the latest floor plans, villa sizes, plot details and
                                currently available units.
                            </p>
                        </div>

                    </details>


                    <details class="landing-faq-item">

                        <summary>
            <span>
                When is the handover for Mareva at The Oasis?
            </span>

                            <span class="landing-faq-toggle" aria-hidden="true"></span>
                        </summary>

                        <div class="landing-faq-answer">
                            <p>
                                Mareva is an off-plan development within The Oasis by Emaar.
                                Buyers should confirm the latest expected handover date and
                                construction schedule for their selected unit before booking.
                            </p>
                        </div>

                    </details>


                    <details class="landing-faq-item">

                        <summary>
            <span>
                Is Mareva at The Oasis a good property investment in Dubai?
            </span>

                            <span class="landing-faq-toggle" aria-hidden="true"></span>
                        </summary>

                        <div class="landing-faq-answer">
                            <p>
                                Mareva may appeal to investors looking for luxury Emaar villas
                                in Dubai within a large master-planned community. Its premium
                                villa concept, spacious homes, Emaar branding and location
                                within The Oasis can make it attractive for long-term ownership,
                                although buyers should evaluate pricing, market conditions and
                                individual investment goals before purchasing.
                            </p>
                        </div>

                    </details>

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
                'source' => 'mareva_popup',
                'propertyId' => $property->id,
                'developerId' => $property->developer_id,
                'action' => route('landing.leads.store'),
                ])

            </div>

        </div>


        <footer class="landing-enquiry-footer" id="contact">

            <div class="landing-enquiry-container">

                <div class="landing-enquiry-grid">

                    {{-- LEFT CONTENT --}}
                    <div class="landing-enquiry-copy">

                        <div class="landing-enquiry-heading">

                        <span class="landing-enquiry-eyebrow">
                            REQUEST PROPERTY DETAILS
                        </span>

                            <h2>
                                Get Pricing, Availability & Project Details
                            </h2>

                            <p>
                                Speak with our property advisor for current availability, pricing, payment plans and
                                complete project information for {{ $property->title }}.
                            </p>

                        </div>
                        <div class="landing-footer-contact-details">

                            {{-- Phone + WhatsApp --}}
                            <div class="landing-footer-contact-item">

                            <span class="landing-footer-contact-icon">
                                <x-landing-icon name="phone"/>
                            </span>

                                <div>
                                <span class="landing-footer-contact-label">
                                    PHONE & WHATSAPP
                                </span>

                                    <a href="tel:{{ preg_replace('/\s+/', '', $siteSettings['phone']) }}">
                                        {{ $siteSettings['phone'] }}
                                    </a>
                                </div>

                            </div>


                            {{-- Alternate --}}
                            <div class="landing-footer-contact-item">

                            <span class="landing-footer-contact-icon">
                                <x-landing-icon name="phone"/>
                            </span>

                                <div>
                                <span class="landing-footer-contact-label">
                                    ALTERNATE
                                </span>

                                    <a href="tel:{{ preg_replace('/\s+/', '', $siteSettings['phone']) }}">
                                        {{ $siteSettings['phone'] }}
                                    </a>
                                </div>

                            </div>


                            {{-- Website --}}
                            <div class="landing-footer-contact-item">

                            <span class="landing-footer-contact-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    aria-hidden="true">

                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M3 12h18"/>
                                    <path d="M12 3c3 3.5 4.5 6.5 4.5 9S15 17.5 12 21"/>
                                    <path d="M12 3C9 6.5 7.5 9.5 7.5 12S9 17.5 12 21"/>

                                </svg>

                            </span>

                                <div>
                                <span class="landing-footer-contact-label">
                                    WEBSITE
                                </span>

                                    <a
                                        href="https://avanorcap.com"
                                        target="_blank"
                                        rel="noopener">
                                        avanorcap.com
                                    </a>
                                </div>

                            </div>


                            {{-- Social --}}
                            <div class="landing-footer-socials">

                                <a
                                    href="https://www.facebook.com/profile.php?id=61592465175120"
                                    target="_blank"
                                    rel="noopener"
                                    aria-label="Facebook">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        aria-hidden="true">
                                        <path
                                            d="M13.5 8H16V4.5h-2.5C10.7 4.5 9 6.2 9 9v2H6v3.5h3V21h3.5v-6.5H16L16.5 11h-4V9c0-.7.3-1 1-1Z"/>
                                    </svg>

                                </a>

                                <a
                                    href="https://www.instagram.com/avanorcapital/"
                                    target="_blank"
                                    rel="noopener"
                                    aria-label="Instagram">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        aria-hidden="true">

                                        <rect x="3" y="3" width="18" height="18" rx="5"/>
                                        <circle cx="12" cy="12" r="4"/>
                                        <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>

                                    </svg>

                                </a>

                            </div>

                        </div>
                        @if (session('lead_success'))
                            <div class="landing-enquiry-alert landing-enquiry-alert-success">
                                {{ session('lead_success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="landing-enquiry-alert landing-enquiry-alert-error">
                                {{ $errors->first() }}
                            </div>
                        @endif

                    </div>


                    {{-- RIGHT FORM --}}
                    <div class="landing-enquiry-form-column">

                        <div
                            class="landing-enquiry-form-card"
                            aria-label="Register Your Interest">

                            @include('partials.lead-form', [
                            'formId' => 'landing-footer-form',
                            'heading' => 'Register Your Interest',
                            'description' => 'Share your details and our property advisor will contact you with pricing, availability and project information.',
                            'buttonText' => 'Submit Enquiry',
                            'source' => 'the_oasis_footer',
                            'propertyId' => $property->id,
                            'developerId' => $property->developer_id,
                            'action' => route('landing.leads.store'),
                            ])

                        </div>

                    </div>

                </div>


            </div>


        </footer>
        <div class="landing-footer-bottom">

            <div class="landing-footer-bottom-inner">

                <p class="landing-footer-copyright">
                    © {{ date('Y') }} Avanor Capital. All rights reserved.
                </p>

                <div class="landing-footer-legal-links">

                    <a href="{{ route('landing.privacy-policy') }}">
                        Privacy Policy
                    </a>

                    <a href="{{ route('landing.terms-and-conditions') }}">
                        Terms & Conditions
                    </a>

                </div>

            </div>

        </div>
    </main>

@endsection
