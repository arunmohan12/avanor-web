<?php

use App\Services\FilterService;
use App\Services\PropertySearchService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;
    protected string $paginationTheme = 'bootstrap';
    
    #[Url(as: 'property_type', except: '', history: true)]
    public string $propertyType = '';

    #[Url(as: 'bedrooms', except: '', history: true)]
    public string $bedrooms = '';

    #[Url(as: 'price', except: '', history: true)]
    public string $price = '';

    #[Url(as: 'community', except: '', history: true)]
    public string $community = '';

    private PropertySearchService $propertySearchService;

    private FilterService $filterService;

    public function boot(
        PropertySearchService $propertySearchService,
        FilterService $filterService
    ): void {
        $this->propertySearchService = $propertySearchService;
        $this->filterService = $filterService;
    }

    public function updatedPropertyType(): void
    {
        $this->resetPage();
    }

    public function updatedBedrooms(): void
    {
        $this->resetPage();
    }

    public function updatedPrice(): void
    {
        $this->resetPage();
    }

    public function updatedCommunity(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->propertyType = '';
        $this->bedrooms = '';
        $this->price = '';
        $this->community = '';

        $this->resetPage();
    }

    public function removeFilter(string $filter): void
    {
        match ($filter) {
            'property_type' => $this->propertyType = '',
            'bedrooms' => $this->bedrooms = '',
            'price' => $this->price = '',
            'community' => $this->community = '',
            default => null,
        };

        $this->resetPage();
    }

    public function render(): View
    {
        $filterData = $this->filterService->getFilters();

        return $this->view([
            ...$filterData,

            'properties' => $this->propertySearchService->search([
                'property_type' => $this->propertyType,
                'bedrooms' => $this->bedrooms,
                'price' => $this->price,
                'community' => $this->community,
            ]),
        ]);
    }
};
?>

<div class="property-search-livewire">

    <div class="property-filter-box">

        <div class="property-filter-header">

            <h4>FILTERS</h4>

            <button
                type="button"
                class="clear-filters"
                wire:click="clearFilters"
                wire:loading.attr="disabled">
                Clear All Filters
            </button>

        </div>

        <div class="property-filter-grid">

            <div class="property-filter-item">


                <x-animated-select
                    label="PROPERTY TYPE"
                    model="propertyType"
                    placeholder="All Property Types"
                    :options="collect($propertyTypes)
        ->mapWithKeys(fn ($type) => [
            $type['id'] => $type['name'],
        ])
        ->all()" />

            </div>

            <div class="property-filter-item">

                <x-animated-select
                    label="BEDROOMS"
                    model="bedrooms"
                    placeholder="All Bedrooms"
                    :options="$bedroomOptions" />

            </div>

            <div class="property-filter-item">
                <x-animated-select
                    label="PRICE RANGE"
                    model="price"
                    :options="$priceRanges" />

            </div>

            <div class="property-filter-item">

                <x-animated-select
                    label="COMMUNITY"
                    model="community"
                    placeholder="All Communities"
                    :options="collect($communities)
        ->mapWithKeys(fn ($community) => [
            $community['id'] => $community['name'],
        ])
        ->all()" />

            </div>

        </div>

        @php
        $selectedPropertyType = collect($propertyTypes)
        ->firstWhere('id', (int) $propertyType);

        $selectedCommunity = collect($communities)
        ->firstWhere('id', (int) $community);

        $hasActiveFilters =
        filled($propertyType) ||
        filled($bedrooms) ||
        filled($price) ||
        filled($community);
        @endphp

        <div class="property-active-filters">

            <span class="active-filter-title">
                Active Filters:
            </span>

            <div class="active-filter-list">

                @if ($selectedPropertyType)
                <button
                    type="button"
                    class="filter-pill"
                    wire:click="removeFilter('property_type')">
                    <strong>Property Type:</strong>

                    <span>
                        {{ $selectedPropertyType['name'] }}
                    </span>

                    <span class="filter-pill-remove">
                        &times;
                    </span>
                </button>
                @endif

                @if (filled($bedrooms) && isset($bedroomOptions[$bedrooms]))
                <button
                    type="button"
                    class="filter-pill"
                    wire:click="removeFilter('bedrooms')">
                    <strong>Bedrooms:</strong>

                    <span>
                        {{ $bedroomOptions[$bedrooms] }}
                    </span>

                    <span class="filter-pill-remove">
                        &times;
                    </span>
                </button>
                @endif

                @if (filled($price) && isset($priceRanges[$price]))
                <button
                    type="button"
                    class="filter-pill"
                    wire:click="removeFilter('price')">
                    <strong>Price Range:</strong>

                    <span>
                        {{ $priceRanges[$price] }}
                    </span>

                    <span class="filter-pill-remove">
                        &times;
                    </span>
                </button>
                @endif

                @if ($selectedCommunity)
                <button
                    type="button"
                    class="filter-pill"
                    wire:click="removeFilter('community')">
                    <strong>Community:</strong>

                    <span>
                        {{ $selectedCommunity['name'] }}
                    </span>

                    <span class="filter-pill-remove">
                        &times;
                    </span>
                </button>
                @endif

                @unless ($hasActiveFilters)
                <span class="no-active-filters">
                    No active filters
                </span>
                @endunless

            </div>

        </div>

    </div>

    <div class="property-results-wrapper">

        <div
            class="property-results-loading"
            wire:loading.flex
            wire:target="propertyType,bedrooms,price,community">

            <div class="search-loader">

                <div class="loader-spinner"></div>

                <p>Finding the best properties...</p>

            </div>

        </div>

        <div
            wire:loading.remove
            wire:target="
                propertyType,
                bedrooms,
                price,
                community,
                clearFilters,
                removeFilter,
                gotoPage,
                nextPage,
                previousPage
            ">



            <div class="th-sort-bar">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md">
                        <p class="woocommerce-result-count"> Showing {{ $properties->firstItem() ?? 0 }}
                            –
                            {{ $properties->lastItem() ?? 0 }}
                            of
                            {{ $properties->total() }}
                            properties
                        </p>
                    </div>

                    <div class="col-md-auto">
                        <div class="sorting-filter-wrap">

                            <div class="nav" role=tablist>
                                <a class="active" href="#" id="tab-shop-list" data-bs-toggle="tab" data-bs-target="#tab-list" role="tab" aria-controls="tab-grid" aria-selected="false"><i class="fa-light fa-grid-2"></i></a>
                                <a href="#" id="tab-shop-grid" data-bs-toggle="tab" data-bs-target="#tab-grid" role="tab" aria-controls="tab-grid" aria-selected="true"><i class="fa-solid fa-list"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-4">

                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade active show" id="tab-list">
                        <div class="row gy-40">
                            @forelse ($properties as $property)

                            @include('properties.card-list', [
                            'property' => $property
                            ])

                            @empty

                            <div class="col-12">
                                <p>No properties found.</p>
                            </div>

                            @endforelse

                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab-grid" role="tabpanel" aria-labelledby="tab-shop-grid">

                        @forelse ($properties as $property)

                        @include('properties.card-grid', [
                        'property' => $property
                        ])

                        @empty

                        <div class="col-12">
                            <p>No properties found.</p>
                        </div>

                        @endforelse
                    </div>
                    

                </div>

                @if ($properties->hasPages())
    <div class="mt-60 text-center">
        {{ $properties->links() }}
    </div>
@endif

            </div>

        </div>

    </div>

</div>