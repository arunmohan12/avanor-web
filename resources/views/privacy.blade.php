@extends('layouts.app')

@section('title', 'Privacy and Policy')
@section('logo', 'logo-dark.svg')

@push('styles')
@vite('resources/css/vendor/privacy.css')
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


<section class="space avanor-privacy-page">
    <div class="container">

        <div class="avanor-privacy-header">
            <span class="sub-title brand-black">
                PRIVACY & COOKIES
            </span>

            <h1 class="sec-title text-theme">
                Privacy & Cookies Policy
            </h1>

            <p class="avanor-privacy-updated">
                Last Updated: August 2026
            </p>
        </div>


        <div class="avanor-privacy-content">

            <div class="avanor-policy-block">
                <h2>How We Protect Your Privacy</h2>

                <p>
                    Avanor Capital respects your privacy and is committed to
                    protecting the personal information you share with us.
                    This policy explains how we collect, use, and protect
                    information when you browse our website or submit an enquiry.
                </p>
            </div>


            <div class="avanor-policy-block">
                <h2>Information We Collect</h2>

                <p>
                    We may collect information such as your name, email address,
                    phone or WhatsApp number, property requirements, preferred
                    locations, enquiry details, IP address, browser information,
                    and website usage data.
                </p>
            </div>


            <div class="avanor-policy-block">
                <h2>How We Use Your Information</h2>

                <p>
                    Your information may be used to respond to enquiries,
                    understand your property requirements, provide relevant
                    information about properties and developments, improve our
                    website, and communicate with you regarding opportunities
                    you have expressed interest in.
                </p>
            </div>


            <div class="avanor-policy-block">
                <h2>Cookies</h2>

                <p>
                    Our website may use cookies and similar technologies to
                    maintain website functionality, remember preferences,
                    understand visitor behaviour, measure performance, and
                    improve the browsing experience.
                </p>

                <p>
                    You can manage or disable cookies through your browser
                    settings. Some website features may not work as expected
                    when certain cookies are disabled.
                </p>
            </div>


            <div class="avanor-policy-block">
                <h2>Sharing Your Information</h2>

                <p>
                    Avanor Capital does not sell your personal information.
                    Information may be shared with trusted service providers
                    where necessary to operate the website, respond to your
                    enquiry, or comply with applicable legal requirements.
                </p>
            </div>


            <div class="avanor-policy-block">
                <h2>Your Privacy Rights</h2>

                <p>
                    Depending on applicable laws, you may request access,
                    correction, deletion, or restriction of personal information
                    held about you, or withdraw consent where applicable.
                </p>
            </div>


            <div class="avanor-policy-block">
                <h2>External Links</h2>

                <p>
                    Our website may contain links to developer websites,
                    social platforms, or other third-party websites.
                    Their privacy practices are governed by their own policies.
                </p>
            </div>


            <div class="avanor-policy-block">
                <h2>Policy Updates</h2>

                <p>
                    We may update this Privacy & Cookies Policy from time to time
                    to reflect changes to our website, services, or applicable
                    requirements.
                </p>
            </div>


            <div class="avanor-policy-block avanor-policy-contact">
                <h2>Contact Us</h2>

                <p>
                    If you have any questions about this policy or how your
                    information is handled, please contact Avanor Capital.
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