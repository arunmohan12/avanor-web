@extends('layouts.app')

@section('title', 'Top Real Estate Developers in Dubai | Avanor Capital')

@section(
'meta_description',
'Explore leading real estate developers across the UAE and discover their latest residential projects, communities and property opportunities with Avanor Capital.'
)

@section('canonical', route('developer.index'))

@section('og_type', 'website')

@section('logo', 'logo-dark.svg')

@push('styles')
@vite('resources/css/vendor/partners.css')
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
            'label' => 'Our Partners',
        ],
    ]" />
    </div>
</section>


<section class="home-filter-section space-bottom filter-home-bottom">

    <div class="container">
        <div class="row gx-80 gy-60">

            <div class="col-xl-12">
                <div class="title-area mb-40">
                    <h1 class="title-area  text-theme">TOP REAL ESTATE DEVELOPERS </h1>
                    <p class="sec-text text-theme">Avanor Capital proudly collaborates with the most reputable real estate developers in Dubai, ensuring you have access to the finest residential opportunities across the city. Each development partner upholds the highest standard in construction, design, and sustainability, allowing us to offer properties that sync with the aspirations and lifestyle of Dubai's dynamic market.</p>
                </div>

            </div>

            <div class="avanor-developers-grid" id="developerGrid">

    @foreach ($developers as $developer)

        <a
            href="{{ route('developers.show', $developer['slug']) }}"
            class="avanor-developer-card"
            data-index="{{ $loop->index }}"
            aria-label="View {{ $developer['name'] }} properties and projects">

            <img
                src="{{ $developer['logo']
                    ? \App\Support\MediaUrl::get($developer['logo'])
                    : asset('assets/img/default-developer-logo.webp') }}"
                alt="{{ $developer['name'] }} real estate developer"
                class="developer-logo-brand"
                loading="lazy"
                decoding="async">

        </a>

    @endforeach

</div>

        </div>
    </div>
</section>
@php
$developersForJs = collect($developers)->map(function ($developer) {
$developer['logo_url'] = !empty($developer['logo'])
? \App\Support\MediaUrl::get($developer['logo'])
: asset('assets/img/default-developer-logo.webp');

return $developer;
})->values();
@endphp

<script>
    window.avanorDevelopers = @json($developersForJs);
</script>
@endsection

@push('scripts')
@vite('resources/js/pages/partners.js')
@endpush