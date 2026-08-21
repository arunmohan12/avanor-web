@extends('layouts.app')

@php
$developerLogoUrl = $developer->logo
? \App\Support\MediaUrl::get($developer->logo)
: asset('assets/img/default-developer-logo.webp');

$developerSchema = [
chr(64) . 'context' => 'https://schema.org',
'@type' => 'Organization',
'name' => $developer->name,
'url' => route('developers.show', $developer->slug),
'description' => $developer->meta_description
?: \Illuminate\Support\Str::limit(
strip_tags($developer->description),
155
),
];

if ($developerLogoUrl) {
$developerSchema['logo'] = $developerLogoUrl;
}
@endphp

@section(
'title',
$developer->meta_title ?: $developer->name . ' Properties Dubai | Avanor Capital'
)

@section(
'meta_description',
$developer->meta_description
?: \Illuminate\Support\Str::limit(
strip_tags($developer->description),
155
)
)

@section('meta_keywords', $developer->meta_keywords)

@section(
'canonical',
route('developers.show', $developer->slug)
)

@section('og_type', 'website')

@if ($developerLogoUrl)
@section('og_image', $developerLogoUrl)
@endif

@section('logo', 'logo-white2.svg')


@push('structured-data')
<script type="application/ld+json">
{!! json_encode(
    $developerSchema,
    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
) !!}
</script>
@endpush

@push('styles')
@vite('resources/css/vendor/devdetails.css')
@endpush

@section('content')

<section class="avanor-property-hero">

    <div
        class="swiper avanor-property-gallery"
        data-slide-count="{{ $properties->count() }}">

        <div class="swiper-wrapper">

            @if ($properties->isNotEmpty())

            @foreach ($properties as $property)

            @php
            $propertyImageUrl = \App\Support\MediaUrl::fromMedia(
            $property->getFirstMedia('cover'),
            'cover_avif'
            );

            if (! $propertyImageUrl) {
            $propertyImageUrl = \App\Support\MediaUrl::fromMedia(
            $property->getFirstMedia('thumbnail'),
            'thumbnail_avif'
            );
            }

            $displayPrice = $property->price
            ?: $property->project?->starting_price;
            @endphp

            <div class="swiper-slide">

                @if ($propertyImageUrl)

                <img
                    src="{{ $propertyImageUrl }}"
                    alt="{{ $property->title }}"
                    class="avanor-property-hero-image"
                    @if ($loop->first)
                fetchpriority="high"
                loading="eager"
                @else
                loading="eager"
                @endif
                decoding="async"
                >

                @endif


                <div class="avanor-property-slide-content">

                    <span class="avanor-property-badge">
                        AVAILABLE PROPERTY
                    </span>

                    <h2 class="avanor-property-slide-title">
                        {{ $property->title }}
                    </h2>


                    @if ($property->project?->location)

                    <p class="avanor-property-slide-location">
                        {{ $property->project->location }}
                    </p>

                    @endif


                    @if ($displayPrice)

                    <div class="avanor-property-slide-price">

                        Starting from

                        <strong>
                            AED {{ number_format($displayPrice) }}
                        </strong>

                    </div>

                    @endif


                    <a
                        href="{{ route('properties.show', $property->slug) }}"
                        class="avanor-property-slide-btn">
                        VIEW PROPERTY

                        <i class="far fa-arrow-right"></i>
                    </a>

                </div>

            </div>

            @endforeach


            @else

            {{-- No properties: show developer logo --}}

            <div class="swiper-slide avanor-developer-logo-slide">

                @php
                $developerLogoUrl = $developer->logo
                ? \App\Support\MediaUrl::get($developer->logo)
                : asset('assets/img/default-developer-logo.webp');
                @endphp

                <div class="avanor-developer-hero-logo">

                    <img
                        src="{{ $developerLogoUrl }}"
                        alt="{{ $developer->name }}"
                        loading="eager"
                        decoding="async">

                </div>

            </div>

            @endif

        </div>


        @if ($properties->count() > 1)

        <button
            type="button"
            class="avanor-property-gallery-prev"
            aria-label="Previous property">
            <i class="far fa-chevron-left"></i>
        </button>

        <button
            type="button"
            class="avanor-property-gallery-next"
            aria-label="Next property">
            <i class="far fa-chevron-right"></i>
        </button>

        <div class="swiper-pagination avanor-property-gallery-pagination"></div>

        @endif

    </div>

</section>


{{-- =========================================================
    BREADCRUMB
========================================================= --}}
<section>
    <div class="container mt-10">

        <x-breadcrumb
            :items="[
            [
                'label' => 'Home',
                'url' => route('home'),
            ],
            [
                'label' => 'Our Partners',
                'url' => route('developer.index'),
            ],
            [
                'label' => $developer->name,
            ],
        ]" />

    </div>
</section>
<section class="avanor-developer-details space-bottom">

    <div class="container">

        {{-- Developer Logo --}}
        <div class="avanor-developer-detail-logo">
            <img
                src="{{ $developerLogoUrl }}"
                alt="{{ $developer->name }}"
                decoding="async">
        </div>

        <div class="row gx-50 ">





            {{-- LEFT: Developer Content --}}
            <div class="col-lg-8">




                @if ($developer->description)
                <div class="avanor-developer-description">
                    <h1>{{ $developer->name }}</h1>

                    {!! $developer->description !!}
                </div>
                @endif

            </div>


            {{-- RIGHT: Form --}}
            <div class="col-lg-4">

                <div class="avanor-developer-form-sticky">



                    <div class="widget widget-property-contact">

                        <p class="widget_text">
                            Connect {{ $developer->name }} With
                            Avanor
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
                                    name="budget"
                                    class="form-control style-border"
                                    placeholder="PREFERRED BUDGET (E.G AED 2M - 5M)"
                                    value="{{ old('budget') }}">
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



                </div>

            </div>

        </div>

    </div>

</section>

<section class="space-bottom">

    <div class="container">

        <div class="avanor-project-listing-header">

            <div>
                <h2 class="avanor-project-listing-title">
                Discover Exceptional Communities Featuring Properties by {{ $developer->name }}                </h2>

                <p class="avanor-project-listing-count">
                    {{ $properties->count() }} listings
                </p>
            </div>

            <div class="avanor-project-listing-actions">

                <button type="button" class="avanor-view-toggle">
                    <i class=""></i>
                   VIEW ALL COMMUNITIES
                </button>

              

            </div>

        </div>


        <div class="avanor-project-grid">

            @foreach ($communities as $community)

            @php
            $thumbnailMedia = $community->getFirstMedia('thumbnail');

            $thumbnailUrl = $thumbnailMedia
            ? \App\Support\MediaUrl::fromMedia(
            $thumbnailMedia,
            'thumbnail_avif'
            )
            : asset('assets/img/property/property-placeholder.webp');
            @endphp


            <article class="avanor-project-card">

                {{-- IMAGE --}}
                <div class="avanor-project-card-image">

                    <img
                        src="{{ $thumbnailUrl }}"
                        alt="{{ $community->name }}"
                        loading="lazy"
                        decoding="async">

                    @if ($community->properties_count > 0)
                    <span class="avanor-project-card-handover">
                        {{ $community->properties_count }}
                        {{ \Illuminate\Support\Str::plural('Property', $community->properties_count) }}
                    </span>
                    @endif

                </div>


                {{-- CONTENT --}}
                <div class="avanor-project-card-content">

                    <h3 class="avanor-project-card-title">

                        <a href="#">
                            {{ $community->name }}
                        </a>

                    </h3>


                    @if ($community->emirate)
                    <div class="avanor-project-card-meta">

                        <span>
                            <i class="far fa-map-marker-alt"></i>
                            {{ $community->emirate->name }}
                        </span>

                    </div>
                    @endif


                    @if ($community->description)

                    <p class="avanor-project-card-description">

                    {{ \Illuminate\Support\Str::limit(
                            html_entity_decode(strip_tags($community->description)),
                            135
                                        ) }}

                    </p>

                    @endif


                    <a
                        href="#"
                        class="avanor-community-card-button">

                        VIEW COMMUNITY

                        <i class="far fa-arrow-right"></i>

                    </a>

                </div>

            </article>

            @endforeach

        </div>

    </div>

</section>


<section class="space-bottom">

    <div class="container">

        <div class="avanor-project-listing-header">

            <div>
                <h2 class="avanor-project-listing-title">
                Projects and New Developments by {{ $developer->name }}
                </h2>

                <p class="avanor-project-listing-count">
                    {{ $properties->count() }} listings
                </p>
            </div>

            <div class="avanor-project-listing-actions">

                <button type="button" class="avanor-view-toggle">
                    <i class=""></i>
                    EXPLORE MORE
                </button>

             
             

            </div>

        </div>


        <div class="avanor-project-grid">

            @foreach ($properties as $property)

                @php
                    $coverMedia = $property->getFirstMedia('cover');

                    $coverUrl = $coverMedia
                        ? \App\Support\MediaUrl::fromMedia($coverMedia, 'cover_avif')
                        : asset('assets/img/property/property-placeholder.webp');

                    $displayPrice = $property->price
                        ?: $property->starting_price
                        ?: $property->project?->starting_price;
                @endphp


                <article class="avanor-project-card">

                    {{-- IMAGE --}}
                    <div class="avanor-project-card-image">

                        <img
                            src="{{ $coverUrl }}"
                            alt="{{ $property->title }}"
                            loading="lazy"
                            decoding="async">


                        {{-- PROPERTY TYPE --}}
                        @if ($property->propertyType)
                            <span class="avanor-project-card-type">
                                {{ $property->propertyType->name }}
                            </span>
                        @endif


                        {{-- HANDOVER --}}
                        @if ($property->handover_year)
                            <span class="avanor-project-card-handover">
                                {{ $property->handover_year }}
                            </span>
                        @endif

                    </div>


                    {{-- CONTENT --}}
                    <div class="avanor-project-card-content">

                        <h3 class="avanor-project-card-title">

                            <a href="{{ route('properties.show', $property->slug) }}">
                                {{ $property->title }}
                            </a>

                        </h3>


                        @if ($property->developer)
                            <div class="avanor-project-card-developer">
                                by
                                <strong>
                                    {{ $property->developer->name }}
                                </strong>
                            </div>
                        @endif


                        @if ($displayPrice)

                            <div class="avanor-project-card-price">

                                <span>Starting Price</span>

                                <strong>
                                    {{ \App\Support\PriceFormatter::aed($displayPrice) }}
                                </strong>

                            </div>

                        @endif


                        <div class="avanor-project-card-meta">

                            @if ($property->community)

                                <span>
                                    <i class="far fa-map-marker-alt"></i>
                                    {{ $property->community->name }}
                                </span>

                            @endif


                            @if ($property->bedrooms)

                                <span>
                                    <i class="far fa-bed"></i>
                                    {{ $property->bedrooms }}
                                </span>

                            @endif

                        </div>


                        @if ($property->short_description)

                            <p class="avanor-project-card-description">
                                {{ \Illuminate\Support\Str::limit(
                                    strip_tags($property->short_description),
                                    135
                                ) }}

                                <a href="{{ route('properties.show', $property->slug) }}">
                                    ...more
                                </a>
                            </p>

                        @endif


                        {{-- ACTIONS --}}
                        <div class="avanor-project-card-actions">

                            <a
                                href="mailto:{{ $siteSettings['email'] }}"
                                class="avanor-project-action">

                                <i class="far fa-envelope"></i>
                                Email

                            </a>


                            <a
                                href="tel:{{ preg_replace('/\s+/', '', $siteSettings['phone']) }}"
                                class="avanor-project-action">

                                <i class="far fa-phone"></i>
                                Call

                            </a>


                            <a
                                href="https://wa.me/{{ preg_replace('/\s+/', '', $siteSettings['phone']) }}"
                                target="_blank"
                                rel="noopener"
                                class="avanor-project-action">

                                <i class="fab fa-whatsapp"></i>
                                WhatsApp

                            </a>

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

    </div>

</section>

@endsection
@push('scripts')
@vite('resources/js/pages/devdetails.js')
@endpush