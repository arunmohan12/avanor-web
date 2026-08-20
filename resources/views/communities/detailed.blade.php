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


            <div class="col-lg-4">

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

            </div>

        </div>

    </div>

</section>


@endsection
@push('scripts')
@endpush