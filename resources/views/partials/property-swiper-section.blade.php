<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-lg-6">
            <div class="title-area">
                <span class="sub-title-dark">SIGNATURE COLLECTIONS</span>
                <h2 class="sec-title brand-light">Exclusive Property Picks </h2>
            </div>
        </div>
        <div class="col-lg-6 d-none d-lg-flex justify-content-end">

            <a
                href="{{ route('properties.index') }}"
                class=" show-allproperties-btn "> VIEW ALL </a>

        </div>
    </div>
    <div class="slider-area property-slider2 slider-drag-wrap z-index-common">
        <div class="swiper th-slider" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"},"1500":{"slidesPerView":"3"}},"spaceBetween":"24","grabCursor":"true","slideToClickedSlide":"true"}'>

            <div class="swiper-wrapper">
            @foreach ($featuredProperties as $property)

                <div class="swiper-slide">
                    <div class="property-card3 style-border">
                        <div class="property-card-thumb ">
                        <img
                        src="{{ $property->thumbnail
                            ? Storage::disk('public')->url($property->thumbnail)
                            : asset('assets/img/property/property3-1.png') }}"
                        alt="{{ $property->title }}"
                    >                        </div>
                        <div class="property-card-details">
                            <h4 class="property-card-title avanor-property-card-title"><a  href="property-details.html"> {{ $property->title }}</a></h4>
                            <p class="property-card-location"><i class="far fa-map-marker-alt me-2"></i>Inner Circular Lamar Street, Houston, Texas</p>
                            <div class="property-card-meta">
                                <span><img src="assets/img/icon/property-icon1-1.svg" alt="img">Bed 4</span>
                                <span><img src="assets/img/icon/property-icon1-2.svg" alt="img">Bath 2</span>
                                <span><img src="assets/img/icon/property-icon1-3.svg" alt="img">1500 sqft</span>
                            </div>
                            <div class="property-btn-wrap">
                            <h4 class="property-card-title avanor-property-card-title">{{ $property->price}}</h4>
                                <div class="btn-wrap">
                                    <a href="property-details.html" class="th-btn style-border2 th-btn-icon">Details</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

               

               

                @endforeach

                

                

            </div>
            
        </div>
    </div>


    <div class="col-auto d-block d-md-none">

        <div class="sec-btn sec-btn-mb-remv btn-mob">

            <a
                href="{{ route('properties.index') }}"
                class=" show-allproperties-btn  ">

                MORE PROPERTIES

            </a>

        </div>

    </div>


</div>