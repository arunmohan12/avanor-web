@extends('layouts.app')

@section('title', 'Top Communities in UAE | Avanor Capital')
@section('logo', 'logo-dark.svg')

@push('styles')
@vite('resources/css/vendor/communities.css')
@endpush

@section('content')

{{-- Hero --}}

<section class="space-top ">
    <div class="container mt-20 mb-10">
        <x-breadcrumb
            :items="[
        [
            'label' => 'Home',
            'url' => route('home'),
        ],
        [
            'label' => 'Top Communities',
        ],
    ]" />
    </div>
</section>


<section class="home-filter-section filter-home-bottom mb-40">

    <div class="container">
        <div class="row gx-80 gy-60">

            <div class="col-xl-12">
                <div class="title-area mb-40">
                    <h2 class="title-area  text-theme">Explore Dubai’s Most Sought-After Communities </h2>
                    <p class="sec-text text-theme">Discover some of Dubai’s most desirable communities, each offering a
                        distinct lifestyle, location advantage, and range of property opportunities.
                        From vibrant waterfront destinations and well-connected urban districts to
                        peaceful family neighborhoods and premium residential enclaves, Dubai offers
                        areas suited to every way of living.
                        Explore each community to learn more about its lifestyle, nearby amenities,
                        residential projects, and investment appeal. Whether you are searching for
                        a new home or comparing locations for your next property investment, find
                        the Dubai community that best matches your goals.
                    </p>
                </div>

            </div>

        </div>
    </div>
</section>





<section class="space-bottom">

    <div class="container">

        <div class="avanor-project-listing-header">

            <div>

                <p class="avanor-project-listing-count">
                    {{ $communities->count() }}
                    {{ \Illuminate\Support\Str::plural('Community', $communities->count()) }}
                </p>

            </div>


            <div class="avanor-community-filter">

                <span class="avanor-community-filter-label">
                    Sort:
                </span>

                <form
                    method="GET"
                    action="{{ route('communities.index') }}"
                    class="avanor-community-filter-form">

                    <div class="avanor-community-select-wrap">

                        <select
                            name="emirate"
                            class="avanor-community-select"
                            onchange="this.form.submit()">

                            <option value="">
                                All Emirates
                            </option>

                            @foreach ($emirates as $emirate)

                            <option
                                value="{{ $emirate->id }}"
                                @selected(request('emirate')==$emirate->id)>

                                {{ $emirate->name }}

                            </option>

                            @endforeach

                        </select>

                        <i class="far fa-chevron-down"></i>

                    </div>

                </form>

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

                        <a  href="{{ route('communities.show', $community->slug) }}">
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
                        href="{{ route('communities.show', $community->slug) }}"
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

@endsection
@push('scripts')
@endpush