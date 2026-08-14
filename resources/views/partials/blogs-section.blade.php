    <div class="container">



        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div class="title-area">
                    <span class="sub-title-dark">NEWS & MARKET INSIGHTS</span>
                    <h2 class="sec-title ">Beyond the Headlines </h2>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-flex justify-content-end">

                <a
                    href="{{route('blogs')}}"
                    class=" community-btn"> See What’s New</a>

            </div>
        </div>

        {{-- Featured Blog --}}
        @if ($featuredBlog)

        <div class="avanor-blog-featured">

            <div class="avanor-blog-featured-image">

                @php
                $thumbnailUrl = \App\Support\MediaUrl::fromMedia(
                $featuredBlog->getFirstMedia('thumbnail'),
                'thumbnail_avif'
                ) ?? asset('assets/img/blog/blog-main.webp');
                @endphp

                <img
                    src="{{ $thumbnailUrl }}"
                    alt="{{ $featuredBlog->title }}">

                @if ($featuredBlog->category)
                <span class="avanor-blog-category">
                    {{ $featuredBlog->category }}
                </span>


                @endif


            </div>

            <div class="avanor-blog-featured-content">

                <h3>
                    {{ $featuredBlog->title }}
                </h3>

                @if ($featuredBlog->published_at)
                <span class="avanor-blog-date">
                    {{ $featuredBlog->published_at->format('F d, Y') }}
                </span>
                @endif

                @if ($featuredBlog->excerpt)
                <p>
                    {{ $featuredBlog->excerpt }}
                </p>
                @endif

                <a href="{{ route('blogs.show', $featuredBlog->slug) }}" class="avanor-blog-read">
                    Continue Reading
                </a>

            </div>

        </div>

        @endif


        {{-- Latest Blogs Slider --}}
        @if ($latestBlogs->isNotEmpty())

        <div
            class="swiper th-slider avanor-blog-swiper"
            data-slider-options='{
                    "breakpoints": {
                        "0": {
                            "slidesPerView": 1.15
                        },
                        "576": {
                            "slidesPerView": 1.5
                        },
                        "768": {
                            "slidesPerView": 2
                        },
                        "1200": {
                            "slidesPerView": 3
                        }
                    },
                    "spaceBetween": 30,
                    "grabCursor": true,
                    "autoplay": false
                }'>

            <div class="swiper-wrapper">

                @foreach ($latestBlogs as $blog)

                @php
                $thumbnailUrl = \App\Support\MediaUrl::fromMedia(
                $blog->getFirstMedia('thumbnail'),
                'thumbnail_avif'
                ) ?? asset('assets/img/blog/blog-main.webp');
                @endphp

                <div class="swiper-slide">

                    <article class="avanor-blog-small">
                    <a href="{{route('blogs.show',$blog->slug)}}">
                        <img
                            src="{{ $thumbnailUrl }}"
                            alt="{{ $blog->title }}"
                            loading="lazy"
                            decoding="async">
                    </a>

                        <div>

                        <a href="{{route('blogs.show',$blog->slug)}}">
                            <h4>
                                {{ $blog->title }}
                            </h4>
                        </a>
                            @if ($blog->published_at)
                            <span>
                                {{ $blog->published_at->format('F d, Y') }}
                            </span>
                            @endif

                        </div>

                    </article>

                </div>

                @endforeach

            </div>

        </div>

    </div>

    @endif

    </div>