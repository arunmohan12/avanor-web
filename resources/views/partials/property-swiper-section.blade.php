<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-lg-6">
            <div class="title-area">
                <span class="sub-title-dark">SIGNATURE COLLECTIONS</span>
                <h2 class="sec-title brand-light">Exclusive Property Picks </h2>
            </div>
        </div>
        <div class="col-lg-6 d-none d-lg-flex justify-content-end">

            <a
                href="{{ route('properties.index') }}"
                class=" show-allproperties-btn "> VIEW ALL </a>

        </div>
    </div>
    <div class="slider-area property-slider2 slider-drag-wrap z-index-common">
        <div class="swiper th-slider" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"},"1500":{"slidesPerView":"3"}},"spaceBetween":"18","grabCursor":"true", "disableOnInteraction":true}'>

            <div class="swiper-wrapper">
                @foreach ($featuredProperties as $property)

                <div class="swiper-slide">

                    <div class="property-card3 style-border">
                        <div class="property-card-thumb ">
                            @php
                            $thumbnailUrl = \App\Support\MediaUrl::fromMedia(
                            $property->getFirstMedia('thumbnail'),
                            'thumbnail_avif'
                            ) ?? asset('assets/img/property/property3-1.png');
                            @endphp

                            <img
                                src="{{ $thumbnailUrl }}"
                                alt="{{ $property->title }}"
                                loading="lazy"
                                decoding="async">
                        </div>
                        <div class="property-card-details">
                            <h4 class="property-card-title avanor-property-card-title"><a href="{{ route('properties.show', $property->slug) }}"> {{ $property->title }}</a></h4>
                            @if (filled($property->project?->location))
                            <p class="property-card-location">
                                <i class="far fa-map-marker-alt me-2"></i>
                                {{ $property->project->location }}
                            </p>
                            @endif
                            <div class="property-card-meta">


                                @if ($property->developer?->name)
                                <span>
                                    <i class="far fa-building"></i>
                                    {{ $property->developer->name }}
                                </span>
                                @endif

                                @php
                                $unitType = $property->unitTypes->first();
                                @endphp

                                @if ($unitType)
                                <span>
                                    <img
                                        src="{{ asset('assets/img/icon/property-icon1-1.svg') }}"
                                        alt="Bedrooms">

                                 

                                    @if ($unitType->bedrooms_from)
                                    {{ $unitType->bedrooms_from }}

                                    @if (
                                    $unitType->bedrooms_to &&
                                    $unitType->bedrooms_to != $unitType->bedrooms_from
                                    )
                                    - {{ $unitType->bedrooms_to }}
                                    @endif
                                    {{ $unitType->propertyType?->name }}
                                    @endif
                                </span>
                                @endif




                            </div>
                            <div class="property-btn-wrap">
                                <div class="property-author-wrap">

                                    @php
                                    $displayPrice = $property->price
                                    ?: $property->project?->starting_price;

                                    $formattedPrice = $displayPrice
                                    ? \App\Support\PriceFormatter::aed($displayPrice)
                                    : null;

                                    $priceWithoutAed = $formattedPrice
                                    ? str_replace('AED ', '', $formattedPrice)
                                    : null;
                                    @endphp

                                    @if ($formattedPrice)
                                    <h4 class="property-card-title avanor-property-card-title">
                                        <span class="aed-symbol">AED</span>
                                        {{ $priceWithoutAed }}
                                    </h4>
                                    @endif

                                </div>
                                <div class="btn-wrap">
                                    <a href="{{ route('properties.show', $property->slug) }}"
                                        class="th-btn style-border2 btn-prop-details">
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>





                @endforeach





            </div>

        </div>
    </div>


    <div class="col-auto d-block d-md-none">

        <div class="sec-btn sec-btn-mb-remv btn-mob">

            <a
                href="{{ route('properties.index') }}"
                class=" show-allproperties-btn  ">

                MORE PROPERTIES

            </a>

        </div>

    </div>


</div>