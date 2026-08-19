@extends('layouts.app')


@section('logo', 'logo-dark.svg')

@push('styles')

@vite('resources/css/vendor/blog.css')
@vite('resources/css/vendor/contact.css')
@endpush

@section('content')
<section class="space-top ">
    <div class="container mt-20 mb-10">
        <x-breadcrumb
            :items="[
        [
            'label' => 'Home',
            'url' => route('home'),
        ],
        [
            'label' => 'Blogs',
        ],
    ]" />
    </div>
</section>

<section class="home-filter-section  filter-home-bottom ">


    <div class="container filter-sizer">
        <div class="text-center">
            <h1 class="hero-title brand-dark blog-heading">Real Estate Insights &</h1>
            <h1 class="hero-title brand-dark blog-heading">Market Updates</h1>

            <span class="sub-title-dark">
                Latest UAE real estate news, trends and investment opportunities.
            </span>
        </div>
    </div>
</section>

<section class="th-blog-wrapper space-top space-extra-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 col-lg-7">
                @foreach ($blogs as $blog)

                <div class="th-blog blog-single has-post-thumbnail">
                    @php
                    $thumbnailUrl = \App\Support\MediaUrl::fromMedia(
                    $blog->getFirstMedia('thumbnail'),
                    'thumbnail_avif'
                    ) ?? asset('assets/img/blog/blog-main.webp');
                    @endphp

                    <div class="blog-img">
                        <a href="{{ route('blogs.show', $blog->slug) }}">
                            <img
                                src="{{ $thumbnailUrl }}"
                                alt="{{ $blog->title }}"
                                loading="lazy"
                                decoding="async">
                        </a>
                    </div>

                    <div class="blog-content">

                        <div class="blog-meta">

                            @if ($blog->published_at)
                            <a href="#">
                                <i class="far fa-clock"></i>
                                {{ $blog->published_at->format('d F, Y') }}
                            </a>
                            @endif

                            @if ($blog->category)
                            <a href="#">
                                <i class="far fa-house-building"></i>
                                {{ $blog->category }}
                            </a>
                            @endif

                        </div>

                        <h2 class="blog-title">
                            <a href="{{ route('blogs.show', $blog->slug) }}">
                                {{ $blog->title }}
                            </a>
                        </h2>

                        @if ($blog->excerpt)
                        <p class="blog-text">
                            {{ $blog->excerpt }}
                        </p>
                        @endif

                        <a href="{{route('blogs.show',$blog->slug)}}"
                            class="th-btn style-border2">
                            READ MORE
                        </a>

                    </div>

                </div>

                @endforeach









                @if ($blogs->hasPages())
                <div class="th-pagination">
                    <ul>

                        @if ($blogs->onFirstPage())
                        {{-- no previous button --}}
                        @else
                        <li>
                            <a
                                class="prev-page"
                                href="{{ $blogs->previousPageUrl() }}">
                                <i class="far fa-arrow-left me-2"></i>
                                Previous
                            </a>
                        </li>
                        @endif

                        @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                        <li>
                            <a
                                href="{{ $url }}"
                                class="{{ $page == $blogs->currentPage() ? 'active' : '' }}">
                                {{ $page }}
                            </a>
                        </li>
                        @endforeach

                        @if ($blogs->hasMorePages())
                        <li>
                            <a
                                class="next-page"
                                href="{{ $blogs->nextPageUrl() }}">
                                Next
                                <i class="far fa-arrow-right ms-2"></i>
                            </a>
                        </li>
                        @endif

                    </ul>
                </div>
                @endif
            </div>
            <div class="col-xxl-4 col-lg-5">
                <aside class="sidebar-area">

                    <div class="widget widget-property-contact">

                        <p class="widget_text">
                            Connect With
                            our Experts
                        </p>

                        @if (session('lead_success'))
    <div class="alert alert-success mb-3">
        {{ session('lead_success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mb-3">
        {{ $errors->first() }}
    </div>
@endif

<form
    action="{{ route('leads.store') }}"
    method="POST"
    class="widget-property-contact-form">

    @csrf

    <input
        type="hidden"
        name="property_id"
        value="{{ $property->id ?? '' }}">

    <input
        type="hidden"
        name="developer_id"
        value="{{ $property->developer_id ?? '' }}">

    <input
        type="hidden"
        name="source"
        value="property_form">

    <input
        type="hidden"
        name="page_url"
        value="{{ url()->current() }}">

    <div class="form-group">
        <input
            type="text"
            name="name"
            class="form-control style-border"
            placeholder="FULL NAME"
            value="{{ old('name') }}"
            required>
    </div>

    <div class="form-group">
        <input
            type="email"
            name="email"
            class="form-control style-border"
            placeholder="EMAIL ADDRESS"
            value="{{ old('email') }}">
    </div>

    <div class="form-group">
        <input
            type="text"
            name="budget"
            class="form-control style-border"
            placeholder="PREFERRED BUDGET (E.G AED 2M - 5M)"
            value="{{ old('budget') }}">
    </div>

    <div class="form-group style-border3 col-md-12">
        <input
            type="tel"
            id="contact_phone"
            name="phone"
            class="form-control"
            placeholder="Phone Number*"
            value="{{ old('phone') }}"
            required>
    </div>

    <button
        type="submit"
        class="th-btn style-white th-btn-icon mt-15 avanor-register-btn">
        REGISTER YOUR INTEREST
    </button>

</form>

                    </div>



                    @if ($recentPosts->isNotEmpty())

                    <div class="widget">
                        <h3 class="widget_title">Recent Posts</h3>

                        <div class="recent-post-wrap">

                            @foreach ($recentPosts as $recentPost)

                            <div class="recent-post">

                                @php
                                $recentThumbnailUrl = \App\Support\MediaUrl::fromMedia(
                                $recentPost->getFirstMedia('thumbnail'),
                                'thumbnail_avif'
                                );
                                @endphp

                                @if ($recentThumbnailUrl)
                                <div class="media-img">
                                    <a href="{{ route('blogs.show', $blog->slug) }}">
                                        <img
                                            src="{{ $recentThumbnailUrl }}"
                                            alt="{{ $recentPost->title }}"
                                            loading="lazy"
                                            decoding="async">
                                    </a>
                                </div>
                                @endif

                                <div class="media-body">

                                    <h4 class="post-title">
                                        <a class="text-inherit" href="{{ route('blogs.show', $blog->slug) }}">
                                            {{ $recentPost->title }}
                                        </a>
                                    </h4>

                                    @if ($recentPost->published_at)
                                    <div class="recent-post-meta">
                                        <a href="#">
                                            <i class="far fa-calendar"></i>
                                            {{ $recentPost->published_at->format('d/m/Y') }}
                                        </a>
                                    </div>
                                    @endif

                                </div>

                            </div>

                            @endforeach

                        </div>
                    </div>

                    @endif


                </aside>
            </div>
        </div>
    </div>
</section>



@endsection
@push('scripts')
<!-- @vite('resources/js/pages/propertydetails.js') -->
@vite('resources/js/pages/contact.js')
@endpush