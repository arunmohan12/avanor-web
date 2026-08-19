@extends('layouts.app')

@section('title', 'About Us')
@section('logo', 'logo-dark.svg')

@push('styles')
@vite('resources/css/vendor/about.css')
@endpush

@section('content')

{{-- Hero --}}

<section class="space ">
    <div class="container mt-20 mb-10">
        <x-breadcrumb
            :items="[
        [
            'label' => 'Home',
            'url' => route('home'),
        ],
        [
            'label' => 'About',
        ],
    ]" />
    </div>
</section>
<section class="space-bottom">
    <div class="overflow-hidden " id="about-sec">

        <div class="container">
            <div class="about-page-wrap">
                <div class="row gy-40 justify-content-between align-items-center">
                    <div class="col-lg-12">
                        <div class="title-area about-title-mb-adjust">
                            <h2 class="sec-title  about-title ">Your Vision, Our Mission — One Remarkable Journey</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <p class="text-theme about-hero-text">
                            At Avanor Capital, we believe finding the right property begins with understanding the person behind the search. Every buyer and investor has different priorities — whether it is finding a place to call home, securing a property in a thriving community, exploring a newly launched development, or identifying an investment opportunity with strong long-term potential. Our role is to understand those ambitions and help turn them into informed property decisions.
                        </p>
                        <p class="text-theme about-hero-text">
                            Our vision is to create a simpler, more transparent way to discover real estate opportunities across the UAE. With a market that continues to grow through new developments, emerging communities, and world-class projects, choosing the right property can often feel complex. Avanor Capital brings together carefully selected properties, reputable developers, desirable communities, and relevant market insights to help clients explore their options with greater clarity.
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <p class="text-theme about-hero-text">
                            Our mission goes beyond presenting property listings. We focus on understanding your budget, preferred location, lifestyle requirements, property preferences, and investment objectives before identifying opportunities that align with what you are actually looking for. From ready properties and family homes to off-plan developments and investment opportunities, our approach is centered around relevance rather than simply offering more choices.
                        </p>
                        <p class="text-theme about-hero-text">
                            We aim to support every stage of the property journey with clear information, thoughtful guidance, and a client-focused approach. By helping you compare locations, communities, developers, projects, pricing, and future potential, we want you to move forward with confidence in the decisions you make.

                            For us, real estate is not simply about finding a property. It is about understanding where you want to go and helping you find the right opportunity to get there. Your vision shapes the journey, and our mission is to help make that journey remarkable.

                        </p>

                    </div>
                    <div class="col-lg-3">


                    </div>
                    <div class="col-lg-6">

                        <div class="about-wrap2 style-theme mt-50">
                            <div class="checklist style4">
                                <ul>
                                    <li><img src="assets/img/icon/checkmark.svg" alt="img">Quality real estate services</li>
                                    <li><img src="assets/img/icon/checkmark.svg" alt="img">100% Satisfaction guarantee</li>
                                    <li><img src="assets/img/icon/checkmark.svg" alt="img">Highly professional team</li>
                                    <li><img src="assets/img/icon/checkmark.svg" alt="img">Dealing always on time</li>
                                </ul>
                            </div>
                            <div class="call-btn">
                                <div class="icon-btn bg-theme ">
                                    <img src="assets/img/icon/phone.svg" alt="img">
                                </div>
                                <div class="btn-content">
                                    <h6 class="btn-title text-theme">Call Us 24/7</h6>
                                    <span class="btn-text"><a class="text-theme" href="tel:0123456789"> {{ $siteSettings['phone'] }}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 d-none d-md-block">


                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<section >

    <div class="why-sec-1 overflow-hidden space bg-theme">

        <div class="container">
            <div class="row justify-content-lg-between align-items-center">
                <div class="col-lg-6">
                    <div class="title-area">
                        <h2 class="sec-title text-white why-choos-mb">Why Choose Us?</h2>
                        <p class="text-light fnt-sm">We are a real estate firm with over 20 years of expertise, and our main goal is to provide amazing locations to our partners and clients. Within the luxury real estate market, our agency offers customized solutions.</p>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="sec-btn">
                        <a href="javascript:void(0)" class="th-btn style-border btn-cta">BOOK A CONSULTATION</a>
                    </div>
                </div>
            </div>
            <div class="swiper th-slider " data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"4"}}}'>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="service-card style4">
                            <div class="service-card-icon icon-box">
                                <img src="{{asset('assets/img/icon/property-single-icon1-2.svg')}}" alt="Icon">
                            </div>
                            <h3 class="box-title"><a href="javascript:void(0)">Property Discovery</a></h3>
                            <p class="box-text">Discover carefully selected apartments, villas, townhouses, and residences that align with your lifestyle, preferred location, and budget.</p>

                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="service-card style4">
                            <div class="service-card-icon icon-box">
                                <img src="{{asset('assets/img/icon/property-single-icon1-6.svg ')}}" alt="Icon">
                            </div>
                            <h3 class="box-title"><a href="javascript:void(0)">Off-Plan Opportunities</a></h3>
                            <p class="box-text">Explore new and upcoming developments from leading UAE developers, with clearer insight into locations, pricing, payment plans, and handover timelines.</p>

                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="service-card style4">
                            <div class="service-card-icon icon-box">
                                <img src="{{asset('assets/img/icon/service-icon5-1.svg ')}}" alt="Icon">
                            </div>
                            <h3 class="box-title"><a href="javascript:void(0)">Investment Opportunities</a></h3>
                            <p class="box-text">Identify real estate opportunities shaped around your investment goals, preferred locations, budget, and long-term property strategy.</p>

                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="service-card style4">
                            <div class="service-card-icon icon-box">
                                <img src="{{asset('assets/img/icon/service-icon4-1.svg ')}}" alt="Icon">
                            </div>
                            <h3 class="box-title"><a href="javascript:void(0)">Community Guidance</a></h3>
                            <p class="box-text">Find the right place to live or invest by exploring established destinations and emerging communities across Dubai and the wider UAE.</p>

                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="service-card style4">
                            <div class="service-card-icon icon-box">
                                <img src="{{asset('assets/img/icon/service-icon4-1.svg ')}}" alt="Icon">
                            </div>
                            <h3 class="box-title"><a href="javascript:void(0)">Developer & Project Insights</a></h3>
                            <p class="box-text">Understand the developers and projects behind each opportunity, helping you compare your options beyond price and property type.</p>

                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="service-card style4">
                            <div class="service-card-icon icon-box">
                                <img src="{{asset('assets/img/icon/service-icon4-1.svg ')}}" alt="Icon">
                            </div>
                            <h3 class="box-title"><a href="javascript:void(0)">Personalized Property Guidance</a></h3>
                            <p class="box-text">From your first enquiry to finding the right opportunity, receive property guidance shaped around what matters most to you.</p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<section class="space avanor-seo-about-section">
    <div class="container">

        <div class="row align-items-start gy-5">



            <div class="col-xl-12">
                <div class="title-area ">
                    <h1 class="sub-title ">ABOUT AVANOR</h1>
                    <div class="title-area">
                        <h2 class="sec-title ">UAE Real Estate Expertise Built Around Your Property Goals</h2>
                    </div>

                    <p class="sec-text text-theme">
                        The right property is more than a location, a price, or a collection of features —
                        it is an opportunity that should fit where you want to go next. From contemporary
                        apartments overlooking Dubai’s skyline and waterfront villas to family communities,
                        new off-plan developments, and promising investment properties, the UAE real estate
                        market offers possibilities for every lifestyle and ambition. At Avanor Capital,
                        we bring those opportunities into focus by connecting buyers and investors with
                        carefully selected properties, leading developers, distinctive projects, and
                        sought-after communities across the UAE.
                    </p>

                    <p class="sec-text text-theme">
                        Whether you are searching for a home that reflects the way you want to live,
                        exploring Dubai’s latest off-plan projects, or considering UAE real estate as part
                        of a long-term investment strategy, we believe the journey should begin with clarity.
                        Avanor Capital helps you discover and compare opportunities through meaningful
                        information on locations, communities, developers, pricing, project status, and
                        handover timelines — so your next property decision is shaped not by how many
                        choices are available, but by how well the right one aligns with your ambitions.
                    </p>
                </div>

            </div>

            <div class="col-lg-12 column-mt">

                <div class="avanor-seo-card-grid">

                    <article class="avanor-seo-card">

                        <span class="avanor-seo-card-number">
                            01
                        </span>

                        <h3>
                            Dubai Properties
                        </h3>

                        <p>
                            Discover apartments, villas, townhouses, and residential
                            properties across Dubai’s established and emerging communities,
                            from ready homes to newly launched developments.
                        </p>

                    </article>


                    <article class="avanor-seo-card ">

                        <span class="avanor-seo-card-number">
                            02
                        </span>

                        <h3>
                            Off-Plan Projects
                        </h3>

                        <p>
                            Explore off-plan properties and new project launches from
                            leading UAE developers, including information on starting prices,
                            locations, payment plans, and expected handover dates.
                        </p>

                    </article>


                    <article class="avanor-seo-card">

                        <span class="avanor-seo-card-number">
                            03
                        </span>

                        <h3>
                            UAE Communities
                        </h3>

                        <p>
                            Discover popular and emerging communities across Dubai and the
                            wider UAE, and compare locations based on available properties,
                            developments, lifestyle, and connectivity.
                        </p>

                    </article>


                    <article class="avanor-seo-card">

                        <span class="avanor-seo-card-number">
                            04
                        </span>

                        <h3>
                            Property Investment
                        </h3>

                        <p>
                            Explore UAE real estate investment opportunities with clearer
                            information on property prices, locations, developers,
                            communities, and projects to support informed decisions.
                        </p>

                    </article>

                </div>

            </div>


        </div>

    </div>
</section>




@endsection