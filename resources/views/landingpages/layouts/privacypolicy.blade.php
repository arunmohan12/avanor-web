@extends('landingpages.layouts.mavera-landing')
@push('styles')
    @vite('resources/css/landingpages/privacy-policy.css')
@endpush
@section('title', 'Privacy Policy | Avanor Capital')

@section(
    'meta_description',
    'Read the Avanor Capital Privacy Policy to understand how we collect, use, store and protect information submitted through our website and property enquiry forms.'
)

@section('robots', 'index,follow')

    @section('content')

        <section class="avanor-privacy-hero">

            <div class="avanor-privacy-container">
                <a
                    href="{{ url()->previous() }}"
                    class="avanor-privacy-back"
                    aria-label="Back to landing page">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true">
                        <path d="M19 12H5"/>
                        <path d="M11 18L5 12L11 6"/>
                    </svg>

                    <span>BACK</span>

                </a>
        <span class="avanor-privacy-eyebrow">
            AVANOR CAPITAL
        </span>

                <h1>
                    Privacy <em>Policy</em>
                </h1>

                <p>
                    Your privacy matters to us. This policy explains how Avanor Capital
                    collects, uses and protects information when you use our website
                    or submit a property enquiry.
                </p>

                <div class="avanor-privacy-updated">
                    Last updated: September 2026
                </div>

            </div>

        </section>


        <section class="avanor-privacy-content">

            <div class="avanor-privacy-container">

                <div class="avanor-privacy-layout">

                    {{-- LEFT NAVIGATION --}}
                    <aside class="avanor-privacy-nav">

                <span class="avanor-privacy-nav-title">
                    ON THIS PAGE
                </span>

                        <nav>
                            <a href="#overview">Overview</a>
                            <a href="#information">Information We Collect</a>
                            <a href="#usage">How We Use Information</a>
                            <a href="#cookies">Cookies & Tracking</a>
                            <a href="#sharing">Information Sharing</a>
                            <a href="#retention">Data Retention</a>
                            <a href="#rights">Your Rights</a>
                            <a href="#security">Data Security</a>
                            <a href="#third-party">Third-Party Websites</a>
                            <a href="#changes">Policy Changes</a>
                            <a href="#contact">Contact Us</a>
                        </nav>

                    </aside>


                    {{-- MAIN CONTENT --}}
                    <article class="avanor-privacy-body">


                        {{-- OVERVIEW --}}
                        <section
                            class="avanor-privacy-section"
                            id="overview">

                    <span class="avanor-privacy-number">
                        01
                    </span>

                            <h2>
                                Overview
                            </h2>

                            <p>
                                This Privacy Policy explains how Avanor Capital
                                ("Avanor", "we", "us" or "our") collects, uses,
                                stores and handles information when you visit our
                                website, interact with our property pages or submit
                                an enquiry.
                            </p>

                            <p>
                                By using our website or providing your information,
                                you acknowledge the practices described in this
                                Privacy Policy.
                            </p>

                        </section>


                        {{-- INFORMATION --}}
                        <section
                            class="avanor-privacy-section"
                            id="information">

                    <span class="avanor-privacy-number">
                        02
                    </span>

                            <h2>
                                Information We Collect
                            </h2>

                            <p>
                                We may collect information that you voluntarily
                                provide when requesting property details,
                                downloading brochures, arranging a consultation
                                or contacting us.
                            </p>

                            <ul>
                                <li>Name</li>
                                <li>Email address</li>
                                <li>Phone or WhatsApp number</li>
                                <li>Property preferences</li>
                                <li>Budget or investment preferences</li>
                                <li>Information included in your enquiry</li>
                            </ul>

                            <h3>
                                Usage Information
                            </h3>

                            <p>
                                When you use our website, certain technical
                                information may be collected automatically,
                                including your IP address, browser type, device
                                information, pages visited, approximate location,
                                referral source and interaction with the website.
                            </p>

                        </section>


                        {{-- USE --}}
                        <section
                            class="avanor-privacy-section"
                            id="usage">

                    <span class="avanor-privacy-number">
                        03
                    </span>

                            <h2>
                                How We Use Your Information
                            </h2>

                            <p>
                                Information collected through Avanor Capital may
                                be used to:
                            </p>

                            <ul>
                                <li>
                                    Respond to property enquiries and requests.
                                </li>

                                <li>
                                    Provide project details, pricing, floor plans
                                    and availability.
                                </li>

                                <li>
                                    Arrange consultations, calls or property
                                    viewings.
                                </li>

                                <li>
                                    Improve our website and user experience.
                                </li>

                                <li>
                                    Measure advertising and marketing performance.
                                </li>

                                <li>
                                    Protect our website against fraud, abuse or
                                    security threats.
                                </li>

                                <li>
                                    Communicate relevant property opportunities
                                    where appropriate.
                                </li>
                            </ul>

                        </section>


                        {{-- COOKIES --}}
                        <section
                            class="avanor-privacy-section"
                            id="cookies">

                    <span class="avanor-privacy-number">
                        04
                    </span>

                            <h2>
                                Cookies & Tracking Technologies
                            </h2>

                            <p>
                                Our website may use cookies, pixels and similar
                                technologies to understand website usage,
                                remember preferences, measure advertising
                                performance and improve our services.
                            </p>

                            <p>
                                These technologies may include analytics and
                                advertising services such as Google Analytics,
                                Google Ads, Meta and other tools configured on
                                our website.
                            </p>

                            <div class="avanor-privacy-note">

                        <span>
                            COOKIE NOTICE
                        </span>

                                <p>
                                    You can control or disable cookies through
                                    your browser settings. Disabling certain
                                    cookies may affect some website functionality.
                                </p>

                            </div>

                        </section>


                        {{-- SHARING --}}
                        <section
                            class="avanor-privacy-section"
                            id="sharing">

                    <span class="avanor-privacy-number">
                        05
                    </span>

                            <h2>
                                How Information May Be Shared
                            </h2>

                            <p>
                                We may share information with trusted service
                                providers where necessary to operate our website,
                                process enquiries, communicate with you or provide
                                relevant property services.
                            </p>

                            <p>
                                Information may also be disclosed when required
                                by applicable law, regulation or a valid request
                                from an authorised public authority.
                            </p>

                            <p>
                                We do not sell personal information as a standalone
                                commercial product.
                            </p>

                        </section>


                        {{-- RETENTION --}}
                        <section
                            class="avanor-privacy-section"
                            id="retention">

                    <span class="avanor-privacy-number">
                        06
                    </span>

                            <h2>
                                Data Retention
                            </h2>

                            <p>
                                Personal information is retained only for as long
                                as reasonably necessary for the purpose for which
                                it was collected, to manage your enquiry, maintain
                                business records and meet applicable legal or
                                regulatory obligations.
                            </p>

                        </section>


                        {{-- RIGHTS --}}
                        <section
                            class="avanor-privacy-section"
                            id="rights">

                    <span class="avanor-privacy-number">
                        07
                    </span>

                            <h2>
                                Your Privacy Choices
                            </h2>

                            <p>
                                Depending on applicable requirements, you may
                                contact us to request access to, correction of or
                                deletion of personal information that you have
                                provided to us.
                            </p>

                            <p>
                                You may also ask us to stop sending marketing
                                communications to you.
                            </p>

                        </section>


                        {{-- SECURITY --}}
                        <section
                            class="avanor-privacy-section"
                            id="security">

                    <span class="avanor-privacy-number">
                        08
                    </span>

                            <h2>
                                Data Security
                            </h2>

                            <p>
                                We take reasonable administrative and technical
                                measures intended to protect information against
                                unauthorised access, loss, misuse, alteration or
                                disclosure.
                            </p>

                            <p>
                                However, no internet transmission or electronic
                                storage system can be guaranteed to be completely
                                secure.
                            </p>

                        </section>


                        {{-- THIRD PARTY --}}
                        <section
                            class="avanor-privacy-section"
                            id="third-party">

                    <span class="avanor-privacy-number">
                        09
                    </span>

                            <h2>
                                Third-Party Websites
                            </h2>

                            <p>
                                Avanor Capital pages may contain links to developer,
                                mapping, social media or other third-party websites.
                                We are not responsible for the privacy practices or
                                content of websites operated by third parties.
                            </p>

                            <p>
                                We recommend reviewing the privacy policy of any
                                external website that you visit.
                            </p>

                        </section>


                        {{-- CHANGES --}}
                        <section
                            class="avanor-privacy-section"
                            id="changes">

                    <span class="avanor-privacy-number">
                        10
                    </span>

                            <h2>
                                Changes to This Privacy Policy
                            </h2>

                            <p>
                                We may update this Privacy Policy from time to time
                                to reflect changes to our website, services,
                                technology or operational requirements.
                            </p>

                            <p>
                                The latest version will always be published on
                                this page together with its updated date.
                            </p>

                        </section>


                        {{-- CONTACT --}}
                        <section
                            class="avanor-privacy-section avanor-privacy-contact"
                            id="contact">

                    <span class="avanor-privacy-number">
                        11
                    </span>

                            <h2>
                                Questions About Your Privacy?
                            </h2>

                            <p>
                                If you have a question regarding this Privacy
                                Policy or information you have submitted through
                                Avanor Capital, please contact our team.
                            </p>

                            <a
                                href="{{ url('/') }}"
                                class="avanor-privacy-contact-btn">

                                CONTACT AVANOR CAPITAL

                            </a>

                        </section>

                    </article>

                </div>

            </div>

        </section>

    @endsection
