<div class="container">
    <div class="slider-area client-slider3">
        <div class="swiper th-slider has-shadow" id="clientSlider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"3"},"768":{"slidesPerView":"4"},"992":{"slidesPerView":"5"},"1200":{"slidesPerView":"6"}}}'>
            <div class="swiper-wrapper">

                @foreach ($developers as $developer)

                <div class="swiper-slide">
             
                    <!-- <a
                        href="{{ route('developers.show', $developer['slug']) }}" -->
                                            <a
                        href="javascript:void(0)"
                        class="client-card">
                        <img
                            src="{{ $developer['logo']
                    ? \Illuminate\Support\Facades\Storage::disk('public')->url($developer['logo'])
                    : asset('assets/img/default-developer-logo.webp') }}"
                            alt="{{ $developer['name'] }}"
                            loading="lazy">
                    </a>

                </div>

                @endforeach

            </div>
        </div>
    </div>
</div>