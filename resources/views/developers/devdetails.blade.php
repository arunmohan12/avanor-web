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
    {
        !!json_encode(
            $developerSchema,
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        ) !!
    }
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



@endsection
@push('scripts')
@vite('resources/js/pages/devdetails.js')
@endpush