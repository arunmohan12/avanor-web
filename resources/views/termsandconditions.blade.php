@extends('layouts.app')

@section('title', 'Terms & Conditions')
@section('logo', 'logo-dark.svg')

@push('styles')
@vite('resources/css/vendor/terms.css')
@endpush

@section('content')


<section class="space-top">
    <div class="container mt-10 mb-10">
        <x-breadcrumb
            :items="[
        [
            'label' => 'Home',
            'url' => route('home'),
        ],
        [
            'label' => 'Privacy & Policy',
        ],
    ]" />
    </div>
</section>

<section class="space-top avanor-terms-page">
    <div class="container">

        <div class="avanor-terms-header">

            <span class="sub-title brand-black">
                LEGAL
            </span>

            <h1 class="sec-title text-theme">
                Terms & Conditions
            </h1>

            <p class="avanor-terms-updated">
                Last Updated: August 2026
            </p>

        </div>


        <div class="avanor-terms-content">

            <div class="avanor-terms-block">
                <h2>Acceptance of Terms</h2>

                <p>
                    By accessing and using the Avanor Capital website, you agree to
                    these Terms & Conditions. These terms govern your use of the
                    website, its content, property information, and related services.
                </p>
            </div>


            <div class="avanor-terms-block">
                <h2>Property Information</h2>

                <p>
                    Avanor Capital provides information about properties, projects,
                    developers, communities, and real estate opportunities across the
                    UAE. We aim to keep this information accurate and current; however,
                    property details may change without prior notice.
                </p>

                <p>
                    Prices, availability, payment plans, completion dates,
                    specifications, amenities, and other property information should
                    be confirmed before making a property or investment decision.
                </p>
            </div>


            <div class="avanor-terms-block">
                <h2>Images & Marketing Materials</h2>

                <p>
                    Images, videos, floor plans, maps, renders, brochures, and other
                    materials displayed on this website may be supplied by property
                    developers or other relevant sources. Visual representations are
                    for illustrative purposes and may differ from the completed
                    property or development.
                </p>
            </div>


            <div class="avanor-terms-block">
                <h2>No Investment Guarantee</h2>

                <p>
                    Information provided on the Avanor Capital website is for general
                    informational purposes and should not be considered financial,
                    legal, or investment advice. Market performance, rental yields,
                    capital appreciation, or other projections do not guarantee future
                    results.
                </p>
            </div>


            <div class="avanor-terms-block">
                <h2>Website Use</h2>

                <p>
                    You agree to use this website only for lawful purposes. You must
                    not interfere with the operation of the website, attempt
                    unauthorised access, misuse its content, or use the website in a
                    manner that may cause damage to Avanor Capital or other users.
                </p>
            </div>


            <div class="avanor-terms-block">
                <h2>Intellectual Property</h2>

                <p>
                    Unless otherwise stated, the Avanor Capital name, website design,
                    branding, written content, graphics, and original materials are
                    protected by applicable intellectual property rights.
                    Third-party developer logos, project materials, and property
                    images remain the property of their respective owners where
                    applicable.
                </p>
            </div>


            <div class="avanor-terms-block">
                <h2>Third-Party Links</h2>

                <p>
                    Our website may contain links to developer websites, social media
                    platforms, maps, or other external services. Avanor Capital is not
                    responsible for the content, security, availability, or privacy
                    practices of third-party websites.
                </p>
            </div>


            <div class="avanor-terms-block">
                <h2>Limitation of Liability</h2>

                <p>
                    Avanor Capital makes reasonable efforts to provide reliable
                    information but does not guarantee that all website content will
                    always be complete, accurate, or current. Users should verify
                    important information before relying on it for property or
                    investment decisions.
                </p>
            </div>


            <div class="avanor-terms-block">
                <h2>Privacy</h2>

                <p>
                    Personal information submitted through this website is handled in
                    accordance with our
                    <a href="{{ route('privacy-policy') }}">
                        Privacy & Cookies Policy
                    </a>.
                </p>
            </div>


            <div class="avanor-terms-block">
                <h2>Changes to These Terms</h2>

                <p>
                    Avanor Capital may update these Terms & Conditions from time to
                    time to reflect changes to our website, services, business
                    practices, or applicable requirements. The latest version will be
                    published on this page.
                </p>
            </div>


            <div class="avanor-terms-block avanor-terms-contact">
                <h2>Contact Us</h2>

                <p>
                    If you have any questions regarding these Terms & Conditions,
                    please contact Avanor Capital.
                </p>

                @if (!empty($siteSettings['phone']))
                    <p>
                        <strong>Phone:</strong>

                        <a href="tel:{{ preg_replace('/\s+/', '', $siteSettings['phone']) }}">
                            {{ $siteSettings['phone'] }}
                        </a>
                    </p>
                @endif

                @if (!empty($siteSettings['email']))
                    <p>
                        <strong>Email:</strong>

                        <a href="mailto:{{ $siteSettings['email'] }}">
                            {{ $siteSettings['email'] }}
                        </a>
                    </p>
                @endif

            </div>

        </div>

    </div>
</section>


<footer class="footer-wrapper footer-default bg-theme">
@include('partials.footer')
</footer>

@endsection