@extends('layouts.app')
@php
$propertyImageUrl = \App\Support\MediaUrl::fromMedia(
$property->getFirstMedia('cover'),
'cover_avif'
);
@endphp

@if ($propertyImageUrl)
@section('og_image', $propertyImageUrl)
@endif
@section(
'title',
$property->meta_title ?: $property->title . ' | Avanor Capital'
)

@section(
'meta_description',
$property->meta_description ?: \Illuminate\Support\Str::limit(
strip_tags($property->description),
155
)
)
@section('meta_keywords', $property->meta_keywords)
@section(
'canonical',
route('properties.show', $property->slug)
)

@php
$displayPrice = $property->price ?: $property->project?->starting_price;

$propertySchema = [
chr(64) . 'context' => 'https://schema.org',
'@type' => 'RealEstateListing',
'name' => $property->title,
'description' => $property->meta_description
?: \Illuminate\Support\Str::limit(
strip_tags($property->description),
155
),
'url' => route('properties.show', $property->slug),
];

if ($propertyImageUrl) {
$propertySchema['image'] = [$propertyImageUrl];
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
'url' => route('properties.show', $property->slug),
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

@section('og_type', 'website')
@section('logo', 'logo-dark.svg')

@push('styles')
@vite('resources/css/vendor/propertydetails.css')
@vite('resources/css/vendor/contact.css')

@endpush

@section('content')



@php
$galleryImages = $property->getMedia('gallery');

$coverMedia = $property->getFirstMedia('cover');

$heroGalleryImages = $galleryImages->take(2);

$activeSections = ($property->sections ?? collect())
->where('is_active', true)
->sortBy('display_order');

$unitTypes = $property->unitTypes ?? collect();

$amenities = ($property->amenities ?? collect())
->sortBy('display_order');

$hasHeroImages =
$galleryImages->isNotEmpty() ||
$coverMedia !== null;

$hasFacts =
filled($property->starting_price) ||
filled($property->price) ||
$unitTypes->isNotEmpty() ||
filled($property->handover_quarter) ||
filled($property->handover_year) ||
filled($property->payment_plan);

$hasProjectDescription = filled($property->project?->description);
@endphp


{{-- =========================================================
    HERO GALLERY
========================================================= --}}
@if ($hasHeroImages)

<section class="avanor-property-hero">

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



{{-- =========================================================
    BREADCRUMB
========================================================= --}}
<section>

    <div class="container mt-10 mb-10">

        <x-breadcrumb
            :items="array_values(array_filter([
                [
                    'label' => 'Home',
                    'url' => route('home'),
                ],

                $property->developer
                    ? [
                        'label' => $property->developer->name,
                    ]
                    : null,

                [
                    'label' => $property->title,
                ],
            ]))" />

    </div>

</section>



<section class="space-bottom space-extra-bottom">

    <div class="container">

        <div class="row gx-30">


            {{-- =====================================================
                PROPERTY OVERVIEW
            ===================================================== --}}
            <div class="col-xxl-8 col-lg-7">

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

                        <form
                            action="#"
                            method="POST"
                            class="widget-property-contact-form">

                            @csrf

                            <input
                                type="hidden"
                                name="property_id"
                                value="{{ $property->id }}">


                            <div class="form-group">

                                <input
                                    type="text"
                                    name="first_name"
                                    class="form-control style-border"
                                    placeholder="FIRST NAME">

                            </div>


                            <div class="form-group">

                                <input
                                    type="text"
                                    name="last_name"
                                    class="form-control style-border"
                                    placeholder="LAST NAME">

                            </div>


                            <div class="form-group">

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control style-border"
                                    placeholder="EMAIL ADDRESS">

                            </div>


                            <div class="form-group">

                                <input
                                    type="text"
                                    name="budget"
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

                    <div class="container">

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

                                <div class="col-lg-12">

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


@endsection
@push('scripts')
@vite('resources/js/pages/propertydetails.js')
@vite('resources/js/pages/contact.js')
@endpush