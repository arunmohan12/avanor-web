@extends('layouts.app')

@section('title', 'Home')

@push('styles')
    @vite('resources/css/pages/home.css')
@endpush

@section('content')

    @include('home.sections.hero')

    @include('home.sections.search')

    @include('home.sections.featured-projects')

    @include('home.sections.featured-properties')

    @include('home.sections.developers')

@endsection

@push('scripts')
    @vite('resources/js/pages/home.js')
@endpush