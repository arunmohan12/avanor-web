<div class="property-filter-box">

    <div class="property-filter-header">

        <h4>FILTERS</h4>

        <a
            href="{{ route('properties.index') }}"
            class="clear-filters">

            Clear All Filters

        </a>

    </div>

    <form
        method="GET"
        action="{{ route('properties.index') }}">

        <div class="property-filter-grid">

            {{-- Property Type --}}
            <div class="property-filter-item">

                <label>PROPERTY TYPE</label>

                <select
                    class="form-select"
                    name="property_type">

                    <option value="">
                        All Property Types
                    </option>

                    @foreach($propertyTypes as $type)

                    <option
                        value="{{ $type['id'] }}"
                        @selected(request('property_type')==$type['id'])>

                        {{ $type['name'] }}

                    </option>

                    @endforeach

                </select>

            </div>

            {{-- Bedrooms --}}
            <div class="property-filter-item">

                <label>BEDROOMS</label>

                <select
                    class="form-select"
                    name="bedrooms">

                    <option value="">
                        All Bedrooms
                    </option>

                    @foreach($bedrooms as $value => $label)

                    <option
                        value="{{ $value }}"
                        @selected(request('bedrooms')==$value)>

                        {{ $label }}

                    </option>

                    @endforeach

                </select>

            </div>

            {{-- Price --}}
            <div class="property-filter-item">

                <label>PRICE RANGE</label>

                <select
                    class="form-select"
                    name="price">

                    <option value="">
                        All Prices
                    </option>

                    @foreach($priceRanges as $value => $label)

                    <option
                        value="{{ $value }}"
                        @selected(request('price')==$value)>

                        {{ $label }}

                    </option>

                    @endforeach

                </select>

            </div>

            {{-- Community --}}
            <div class="property-filter-item">

                <label>COMMUNITY</label>

                <select
                    class="form-select"
                    name="community">

                    <option value="">
                        All Communities
                    </option>

                    @foreach($communities as $community)

                    <option
                        value="{{ $community['id'] }}"
                        @selected(request('community')==$community['id'])>

                        {{ $community['name'] }}

                    </option>

                    @endforeach

                </select>

            </div>

        </div>

    </form>

    <div class="property-active-filters">

   

        {{-- Active Filters --}}
        @php
        $activeFilters = [];

        if (request()->filled('property_type')) {
        $selectedPropertyType = collect($propertyTypes)
        ->firstWhere('id', (int) request('property_type'));

        if ($selectedPropertyType) {
        $activeFilters[] = [
        'key' => 'property_type',
        'title' => 'Property Type',
        'label' => $selectedPropertyType['name'],
        ];
        }
        }

        if (request()->filled('bedrooms')) {
        $bedroomValue = request('bedrooms');

        if (isset($bedrooms[$bedroomValue])) {
        $activeFilters[] = [
        'key' => 'bedrooms',
        'title' => 'Bedroom',
        'label' => $bedrooms[$bedroomValue],
        ];
        }
        }

        if (request()->filled('price')) {
        $priceValue = request('price');

        if (isset($priceRanges[$priceValue])) {
        $activeFilters[] = [
        'key' => 'price',
        'title' => 'Price Range',
        'label' => $priceRanges[$priceValue],
        ];
        }
        }

        if (request()->filled('community')) {
        $selectedCommunity = collect($communities)
        ->firstWhere('id', (int) request('community'));

        if ($selectedCommunity) {
        $activeFilters[] = [
        'key' => 'community',
        'title' => 'Community',
        'label' => $selectedCommunity['name'],
        ];
        }
        }
        @endphp

        @if(count($activeFilters))
        <div class="property-active-filters">

            <span class="active-filter-title">
                Active Filters:
            </span>

            <div class="active-filter-list">

                @foreach($activeFilters as $filter)

                @php
                $removeFilterUrl = route(
                'properties.index',
                request()->except($filter['key'])
                );
                @endphp

                <a
                    href="{{ $removeFilterUrl }}"
                    class="filter-pill">

                    <strong>
                        {{ $filter['title'] }}:
                    </strong>

                    <span>
                        {{ $filter['label'] }}
                    </span>

                    <span class="filter-pill-remove" aria-hidden="true">
                        ×
                    </span>

                </a>

                @endforeach

            </div>

        </div>
        @endif

    </div>

</div>