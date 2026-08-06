@extends('layouts.app')

@section('title', 'Home')

@push('styles')
    @vite('resources/css/pages/home.css')
@endpush

@section('content')

    @include('home.sections.hero')



@endsection

@push('scripts')
    @vite('resources/js/pages/home.js')
@endpush