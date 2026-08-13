<div class="col-md-6 col-xl-4">
    <div class="property-card2">

        <div class="property-card-thumb ">
            @php
            $coverUrl = \App\Support\MediaUrl::fromMedia(
            $property->getFirstMedia('cover'),
            'cover_avif'
            );
            @endphp

            <img
                src="{{ $coverUrl ?: asset('assets/img/property/rhrbvdewfwuiiko2qlmk.avif') }}"
                alt="{{ $property->title }}"
                loading="lazy"
                decoding="async">
        </div>


        <!-- <a href="{{ route('properties.show', $property->slug) }}">
            <div class="property-card-thumb">
                <img
                    src="{{ asset('assets/img/property/rhrbvdewfwuiiko2qlmk.avif') }}"
                    alt="{{ $property->title }}"
                    loading="lazy"
                    decoding="async">
            </div>
        </a> -->

        <div class="property-card-details">

            <div class="media-left">
                @if ($property->developer)
                <h5 class="property-card-developer">
                    {{ $property->developer->name }}
                </h5>
                @endif
                <h4 class="property-card-title">
                    <a href="{{ route('properties.show', $property->slug) }}">
                        {{ $property->title }}
                    </a>
                </h4>



                @if ($property->community )
                <p class="property-card-location">
                    <i class="far fa-map-marker-alt me-2"></i>
                    {{ $property->community?->name }}
                    @if ($property->community && $property->emirate)

                    @endif

                </p>
                @endif

            </div>

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

            <div class="property-card-price-meta">

                <h5 class="property-card-price">
                    <span class="aed-symbol">AED</span>
                    {{ $priceWithoutAed }}
                </h5>

            </div>

            @endif

        </div>

    </div>
</div>