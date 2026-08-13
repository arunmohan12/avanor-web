<div class="container">

    <div class="row align-items-center">

        <div class="col-lg-6">

            <div class="title-area ">

                <span class="sub-title ">
                    EXPLORE COMMUNITIES
                </span>

                <h2 class="sec-title text-theme">
                    Trending Communities
                </h2>

            </div>

        </div>

        <div class="col-lg-6 d-none d-lg-flex justify-content-end">

            <a
                href="{{ route('properties.index') }}"
                class=" community-btn ">

                SHOW MORE

            </a>

        </div>

    </div>

    @php

    $rowOne = $featuredCommunities->take(3);

    $rowTwo = $featuredCommunities->slice(3, 3);

    $rowOneColumns = [
    'col-xl-3 col-md-6',
    'col-xl-3 col-md-6',
    'col-xl-6 col-md-6',
    ];

    $rowTwoColumns = [
    'col-xl-6 col-md-6',
    'col-xl-3 col-md-6',
    'col-xl-3 col-md-6',
    ];

    @endphp

    {{-- =========================
         ROW 1
    ========================== --}}

    <div class="row community-grid-row  gy-3">

        @foreach($rowOne as $community)

        <div class="{{ $rowOneColumns[$loop->index] }}">

            <div class="destination-card ">

                <div class="card-thumb">

                    <a href="{{ route('properties.index', [
                            'community' => $community->id,
                        ]) }}">

                        @php
                        $thumbnailUrl = \App\Support\MediaUrl::fromMedia(
                        $community->getFirstMedia('thumbnail'),
                        'thumbnail_avif'
                        );
                        @endphp

                        @if ($thumbnailUrl)
                        <img
                            src="{{ $thumbnailUrl }}"
                            alt="{{ $community->name }}"
                            loading="lazy"
                            decoding="async">
                        @endif

                    </a>

                </div>

                <div class="card-details text-start">

                    <h4 class="box-title">

                        <a href="{{ route('properties.index', [
                                'community' => $community->id,
                            ]) }}">

                            {{ $community->name }}

                        </a>

                    </h4>

                    <p class="box-text">

                        {{ str_pad($community->properties_count, 2, '0', STR_PAD_LEFT) }}

                        {{ Str::plural('Property', $community->properties_count) }}

                    </p>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    {{-- =========================
         ROW 2
    ========================== --}}

    <div class="row community-grid-row  gy-3 mt-0">

        @foreach($rowTwo as $community)

        <div class="{{ $rowTwoColumns[$loop->index] }}">

            <div class="destination-card ">

                <div class="card-thumb">

                    <a href="{{ route('properties.index', [
                            'community' => $community->id,
                        ]) }}">

                        <a href="{{ route('properties.index', [
                            'community' => $community->id,
                        ]) }}">

                            @php
                            $thumbnailUrl = \App\Support\MediaUrl::fromMedia(
                            $community->getFirstMedia('thumbnail'),
                            'thumbnail_avif'
                            );
                            @endphp

                            @if ($thumbnailUrl)
                            <img
                                src="{{ $thumbnailUrl }}"
                                alt="{{ $community->name }}"
                                loading="lazy"
                                decoding="async">
                            @endif

                        </a>

                </div>

                <div class="card-details text-start">

                    <h4 class="box-title">

                        <a href="{{ route('properties.index', [
                                'community' => $community->id,
                            ]) }}">

                            {{ $community->name }}

                        </a>

                    </h4>

                    <p class="box-text">

                        {{ str_pad($community->properties_count, 2, '0', STR_PAD_LEFT) }}

                        {{ Str::plural('Property', $community->properties_count) }}

                    </p>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <div class="col-auto d-block d-md-none">

        <div class="sec-btn sec-btn-mb-remv btn-mob">

            <a
                href="{{ route('properties.index') }}"
                class=" community-btn  ">

                SHOW MORE

            </a>

        </div>

    </div>

</div>