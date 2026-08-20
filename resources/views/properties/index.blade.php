@extends('layouts.app')
@section('title', 'Properties for Sale in the UAE | Avanor Capital')
@section(
    'meta_description',
    'Explore properties for sale across Dubai and the UAE, including apartments, villas and new developments from leading real estate developers.'
)
@section('canonical', route('properties.index'))
@section('og_type', 'website')
@section('logo_secondary', 'logo-white2.svg')

@push('styles')
@vite('resources/css/vendor/property-search.css')
@endpush

@section('content')




<section class="property-search-page ">

    <div class="container property-search-container">
        <x-breadcrumb
            :items="[
        [
            'label' => 'Home',
            'url' => route('home'),
        ],
        [
            'label' => 'Property Search',
        ],
    ]" />
        <h1 class="property-search-title">
            PROPERTY SEARCH RESULTS
        </h1>

        <livewire:property-search />

    </div>

</section>

@endsection