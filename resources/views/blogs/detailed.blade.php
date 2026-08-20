@extends('layouts.app')

@section('logo', 'logo-dark.svg')

@php
    $featuredImageUrl = \App\Support\MediaUrl::fromMedia(
        $blog->getFirstMedia('featured_image'),
        'featured_image_avif'
    );

    $articleSchema = [
        chr(64) . 'context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $blog->title,
        'description' => $blog->meta_description ?: $blog->excerpt,
        'datePublished' => optional($blog->published_at)->toIso8601String(),
        'dateModified' => optional($blog->updated_at)->toIso8601String(),
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => route('blogs.show', $blog->slug),
        ],
        'author' => [
        '@type' => 'Organization',
        'name' => 'Avanor Capital',
        'url' => url('/'),
    ],

        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Avanor Capital',
            'url' => url('/'),
        ],
    ];

    if ($featuredImageUrl) {
        $articleSchema['image'] = [$featuredImageUrl];
    }

    $breadcrumbSchema = [
        chr(64) . 'context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => route('home'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Blogs',
                'item' => route('blogs'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $blog->title,
                'item' => route('blogs.show', $blog->slug),
            ],
        ],
    ];
@endphp

@section(
    'title',
    $blog->meta_title ?: $blog->title . ' | Avanor Capital'
)

@section(
    'meta_description',
    $blog->meta_description ?: $blog->excerpt
)



@section(
    'canonical',
    route('blogs.show', $blog->slug)
)

@section('og_type', 'article')

@if ($featuredImageUrl)
    @section('og_image', $featuredImageUrl)
@endif

@push('structured-data')

<script type="application/ld+json">
{!! json_encode(
    $articleSchema,
    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
) !!}
</script>

<script type="application/ld+json">
{!! json_encode(
    $breadcrumbSchema,
    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
) !!}
</script>

@endpush

@push('styles')
    @vite('resources/css/vendor/blog.css')
@endpush

@section('content')

<section class="space-top">
    <div class="container mt-10">

        <x-breadcrumb
            :items="[
                [
                    'label' => 'Home',
                    'url' => route('home'),
                ],
                [
                    'label' => 'Blogs',
                    'url' => route('blogs'),
                ],
                [
                    'label' => $blog->title,
                ],
            ]" />

    </div>
</section>

<section class="home-filter-section filter-home-bottom">

    <div class="container filter-sizer">

        <div class="text-center">

            <h1 class="hero-title brand-dark blog-heading-det">
                {{ $blog->title }}
            </h1>

            <span class="sub-title-dark">

                @if ($blog->published_at)
                {{ $blog->published_at->format('F d, Y') }}
                @endif

                @if ($blog->category)
                <span class="mx-2">/</span>
                {{ $blog->category }}
                @endif

            </span>

        </div>



        <div class="th-blog blog-single mb-0">
                    <div class="blog-img ">
                        @if ($featuredImageUrl)
                        <div class="blog-img">
                            <img
                                src="{{ $featuredImageUrl }}"
                                alt="{{ $blog->title }}"
                                decoding="async">
                        </div>
                        @endif
                    </div>
                    <div class="blog-content">

                        @if ($blog->category || $blog->published_at)

                        <div class="blog-meta">

                            @if ($blog->published_at)
                            <span>
                                <i class="far fa-clock"></i>
                                {{ $blog->published_at->format('d F, Y') }}
                            </span>
                            @endif

                            @if ($blog->category)
                            <span>
                                <i class="far fa-house-building"></i>
                                {{ $blog->category }}
                            </span>
                            @endif

                        </div>

                        @endif


                        <div class="blog-text-content">
                            {!! $blog->content !!}
                        </div>

                    </div>
                </div>
    </div>


</section>


<!-- <section class="th-blog-wrapper blog-details space-top space-extra-bottom">
    <div class="container">
        <div class="row ">
            <div class="col-xxl-8 col-lg-7">
                <div class="th-blog blog-single mb-0">
                    <div class="blog-img">
                        @if ($featuredImageUrl)
                        <div class="blog-img">
                            <img
                                src="{{ $featuredImageUrl }}"
                                alt="{{ $blog->title }}"
                                decoding="async">
                        </div>
                        @endif
                    </div>
                    <div class="blog-content">

                        @if ($blog->category || $blog->published_at)

                        <div class="blog-meta">

                            @if ($blog->published_at)
                            <span>
                                <i class="far fa-clock"></i>
                                {{ $blog->published_at->format('d F, Y') }}
                            </span>
                            @endif

                            @if ($blog->category)
                            <span>
                                <i class="far fa-house-building"></i>
                                {{ $blog->category }}
                            </span>
                            @endif

                        </div>

                        @endif


                        <div class="blog-text-content">
                            {!! $blog->content !!}
                        </div>

                    </div>
                </div>
                <div class="share-links clearfix ">
                    <div class="row justify-content-between">

                        <div class="col-md-auto text-xl-end">
                            <span class="share-links-title">Share:</span>
                            <div class="th-social style2 align-items-center">
                                <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @if ($recentPosts->isNotEmpty())

            <div class="col-xxl-4 col-lg-5">

                <aside class="sidebar-area">

                    <div class="widget">

                        <h3 class="widget_title">
                            Recent Posts
                        </h3>

                        <div class="recent-post-wrap">

                            @foreach ($recentPosts as $recentPost)

                            @php
                            $recentThumbnailUrl = \App\Support\MediaUrl::fromMedia(
                            $recentPost->getFirstMedia('thumbnail'),
                            'thumbnail_avif'
                            );
                            @endphp

                            <div class="recent-post">

                                @if ($recentThumbnailUrl)

                                <div class="media-img">

                                    <a href="{{ route('blogs.show', $recentPost->slug) }}">

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

                                        <a
                                            class="text-inherit"
                                            href="{{ route('blogs.show', $recentPost->slug) }}">
                                            {{ $recentPost->title }}
                                        </a>

                                    </h4>

                                    @if ($recentPost->published_at)

                                    <div class="recent-post-meta">

                                        <a href="{{ route('blogs.show', $recentPost->slug) }}">

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

                </aside>

            </div>

            @endif
        </div>
    </div>
</section> -->
@endsection
@push('scripts')
@endpush