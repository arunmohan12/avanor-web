<div class="tab-content">

    <div class="tab-pane fade show active"
        id="rent-tab-pane"
        role="tabpanel">

        <form class="property-search-form" method="GET" action="{{ route('properties.index') }}">

            {{-- Property Type --}}
            <div class="search-item">

                <select class="form-select" name="property_type">

                    <option value="">
                        PROPERTY TYPE
                    </option>

                    @foreach($propertyTypes as $type)

                    <option value="{{ $type['id'] }}">
                        {{ strtoupper($type['name']) }}
                    </option>

                    @endforeach

                </select>

            </div>

            {{-- Bedroom --}}
            <div class="search-item" >

                <select class="form-select" name="bedrooms">

                    <option value="">
                        BEDROOM
                    </option>

                    @foreach($bedrooms as $value => $label)

                    <option value="{{ $value }}">
                        {{ strtoupper($label) }}
                    </option>

                    @endforeach

                </select>

            </div>

            {{-- Price --}}
            <div class="search-item">

                <select class="form-select" name="price">

                    <option value="">PRICE RANGE</option>

                    @foreach($priceRanges as $value => $label)

                    <option value="{{ $value }}">
                        {{ strtoupper($label) }}
                    </option>

                    @endforeach

                </select>

            </div>

            {{-- Community --}}
            <div class="search-item" >

                <select class="form-select" name="community">

                    <option value="">
                        COMMUNITY
                    </option>

                    @foreach($communities as $community)

                    <option value="{{ $community['id'] }}">
                        {{ strtoupper($community['name']) }}
                    </option>

                    @endforeach

                </select>

            </div>

            <button
                type="reset"
                class="clear-btn">

                CLEAR ALL

            </button>

            <button
                type="submit"
                class="th-btn search-btn">

                SEARCH PROPERTIES

            </button>

        </form>

    </div>

</div>