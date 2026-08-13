<div class="property-card-wrap style-dark">
    <div class="property-thumb img-grid-card">
        <!-- <img src="assets/img/property/property1-1.png" alt="img"> -->
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
    <div class="property-card style-dark">

        <div class="property-card-details">
            @if ($property->propertyType)
            <span class="property-card-subtitle">
                {{ $property->propertyType->name }}
            </span>
            @endif
            <h4 class="property-card-title"><a href="property-details.html"> {{ $property->title }}</a></h4>
            @if ($property->description)
            <div class="property-card-text">
                {{ \Illuminate\Support\Str::limit(strip_tags($property->description), 120) }}
            </div>
            @endif
            @if ($property->price)
            <div class="property-card-price-meta">
                <!-- <h5 class="property-card-price">
                    AED {{ number_format($property->price) }}
                </h5> -->

                @php
                $formattedPrice = $property->formatted_price;
                $priceWithoutAed = str_replace('AED ', '', $formattedPrice);
                @endphp
                <h5 class="property-card-price">
                    <span class="aed-symbol">AED</span>
                    {{ $priceWithoutAed }}
                </h5>

            </div>
            @endif
            @if ($property->bedrooms || $property->bathrooms)
            <div class="property-card-meta">

                @if ($property->bedrooms)
                <span>
                    <img src="{{ asset('assets/img/icon/property-icon1-1.svg') }}" alt="">
                    Bed {{ $property->bedrooms }}
                </span>
                @endif

                @if ($property->bedrooms && $property->bathrooms)
                <span class="divider-line"></span>
                @endif

                @if ($property->bathrooms)
                <span>
                    <img src="{{ asset('assets/img/icon/property-icon1-2.svg') }}" alt="">
                    Bath {{ $property->bathrooms }}
                </span>
                @endif

            </div>
            @endif
            <div class="property-btn-wrap">

                <a
                    href="{{ route('properties.show', $property->slug) }}"
                    class="th-btn style-border2 ">
                    Details
                </a>
            </div>
        </div>
    </div>
</div>