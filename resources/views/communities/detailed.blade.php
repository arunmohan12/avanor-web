@extends('layouts.app')

@section('title', 'Top Communities in UAE | Avanor Capital')
@section('logo', 'logo-dark.svg')

@push('styles')
@vite('resources/css/vendor/communitiesdetailed.css')
@endpush

@section('content')

{{-- Hero --}}


<section class="community-detail-hero">

    @php
    $heroMedia = $community->getFirstMedia('hero');

    $heroUrl = $heroMedia
    ? \App\Support\MediaUrl::fromMedia($heroMedia, 'hero_avif')
    : asset('assets/img/community/community-placeholder.webp');
    @endphp

    <img
        src="{{ $heroUrl }}"
        alt="{{ $community->name }}"
        class="community-detail-hero-image"
        fetchpriority="high"
        decoding="async">

    <div class="community-detail-hero-overlay"></div>

    <div class="container community-detail-hero-container">

        <div class="community-detail-hero-content">

            <span class="community-detail-hero-eyebrow">
                COMMUNITY GUIDE
            </span>

            <h1>
                {{ $community->name }} Guide
            </h1>

            <p>
                Discover the lifestyle, location, amenities and property opportunities
                available in {{ $community->name }}.
            </p>

            <a
                href="#community-properties"
                class="community-detail-hero-btn">

                Explore Properties

                <i class="far fa-arrow-right"></i>

            </a>

        </div>

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
            'label' => 'Top Communities',
            'url' => route('communities.index'),
        ],

        [
            'label' => $community->name,
      
        ],
    ]" />
    </div>
</section>


<section class="space-bottom">

    <div class="container">

        <div class="row gx-50">

            <div class="col-lg-8">

                @if ($community->description)

                    <div class="community-description">

                        <h6 class="description-heading">
                            ABOUT {{ $community->name }}
                        </h6>

                        {!! $community->description !!}

                    </div>

                @endif

            </div>


            <!-- <div class="col-lg-4">

                <aside class="community-new-launches">

                    <div class="community-new-launches-header">

                        <span class="community-new-launches-eyebrow">
                            NEW LAUNCHES
                        </span>

                        <h3>
                            Latest Projects in {{ $community->name }}
                        </h3>

                    </div>


                    <div class="community-new-launches-list">

                        @forelse ($newLaunches as $project)

                            @php
                                $thumbnailMedia = $project->getFirstMedia('thumbnail');

                                $thumbnailUrl = $thumbnailMedia
                                    ? \App\Support\MediaUrl::fromMedia(
                                        $thumbnailMedia,
                                        'thumbnail_avif'
                                    )
                                    : asset('assets/img/property/property-placeholder.webp');
                            @endphp


                            <article class="community-launch-card">

                                <a
                                    href=""
                                    class="community-launch-card-image">

                                    <img
                                        src="{{ $thumbnailUrl }}"
                                        alt="{{ $project->name }}"
                                        loading="lazy"
                                        decoding="async">

                                </a>


                                <div class="community-launch-card-content">

                                    <span class="community-launch-card-label">
                                        NEW LAUNCH
                                    </span>


                                    <h4>

                                        <a href="">
                                            {{ $project->name }}
                                        </a>

                                    </h4>


                                    @if ($project->developer)

                                        <p class="community-launch-card-developer">
                                            By {{ $project->developer->name }}
                                        </p>

                                    @endif


                                    @if ($project->starting_price)

                                        <div class="community-launch-card-price">

                                            <span>
                                                Starting from
                                            </span>

                                            <strong>
                                                {{ \App\Support\PriceFormatter::aed(
                                                    $project->starting_price
                                                ) }}
                                            </strong>

                                        </div>

                                    @endif

                                </div>

                            </article>

                        @empty

                            <p class="community-new-launches-empty">
                                New project launches will be added soon.
                            </p>

                        @endforelse

                    </div>

                </aside>

            </div> -->

        </div>

    </div>

</section>


<section class="space-bottom">

    <div class="container">

        <div class="avanor-project-listing-header">

            <div>
                <h2 class="avanor-project-listing-title">
                Properties by {{ $community ->name }}
                </h2>

                <p class="avanor-project-listing-count">
                    {{ $properties->count() }} listings
                </p>
            </div>

            <!-- <div class="avanor-project-listing-actions">

                <button type="button" class="avanor-view-toggle">
                    <i class=""></i>
                    EXPLORE MORE
                </button>

             
             

            </div> -->

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
@endpush