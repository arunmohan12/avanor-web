@extends('layouts.app')

<!-- @section(
    'title',
    $property->meta_title ?: $property->title . ' | Avanor'
)

@section(
    'meta_description',
    $property->meta_description ?: \Illuminate\Support\Str::limit(
        strip_tags($property->description),
        155
    )
)
@section('meta_keywords', $property->meta_keywords) -->
@section('logo', 'logo-dark.svg')

@push('styles')

@vite('resources/css/vendor/blog.css')

@endpush

@section('content')


@endsection
@push('scripts')
@vite('resources/js/pages/propertydetails.js')
<!-- @vite('resources/js/pages/contact.js') -->
@endpush
