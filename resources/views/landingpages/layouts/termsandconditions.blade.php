@extends('landingpages.layouts.mavera-landing')

@push('styles')
    @vite('resources/css/landingpages/terms-conditions.css')
@endpush

@section('title', 'Terms & Conditions | Avanor Capital')

@section(
    'meta_description',
    'Read the Terms and Conditions governing the use of Avanor Capital websites, property listings, project information and enquiry services.'
)

@section('robots', 'index,follow')


@section('content')

    <section class="avanor-terms-hero">

        <div class="avanor-terms-container">

            {{-- Back --}}
            <a
                href="{{ url()->previous() }}"
                class="avanor-terms-back"
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


            <span class="avanor-terms-eyebrow">
            AVANOR CAPITAL
        </span>

            <h1>
                Terms &amp;
                <em>Conditions</em>
            </h1>

            <p>
                These Terms &amp; Conditions govern your use of Avanor Capital
                websites, property pages, project information and enquiry services.
            </p>

            <div class="avanor-terms-updated">
                Last updated: September 2026
            </div>

        </div>

    </section>


    <section class="avanor-terms-content">

        <div class="avanor-terms-container">

            <div class="avanor-terms-layout">


                {{-- =====================================================
                    LEFT NAVIGATION
                ===================================================== --}}

                <aside class="avanor-terms-nav">

                <span class="avanor-terms-nav-title">
                    ON THIS PAGE
                </span>

                    <nav>
                        <a href="#acceptance">Acceptance of Terms</a>
                        <a href="#website-use">Use of Website</a>
                        <a href="#property-information">Property Information</a>
                        <a href="#prices">Prices & Availability</a>
                        <a href="#visuals">Images & Renders</a>
                        <a href="#developer">Developer Information</a>
                        <a href="#investment">Investment Disclaimer</a>
                        <a href="#enquiries">Enquiries & Communication</a>
                        <a href="#third-party">Third-Party Services</a>
                        <a href="#intellectual-property">Intellectual Property</a>
                        <a href="#liability">Limitation of Liability</a>
                        <a href="#changes">Changes to Terms</a>
                        <a href="#law">Governing Law</a>
                        <a href="#contact">Contact</a>
                    </nav>

                </aside>


                {{-- =====================================================
                    MAIN CONTENT
                ===================================================== --}}

                <article class="avanor-terms-body">


                    {{-- 01 --}}
                    <section
                        class="avanor-terms-section"
                        id="acceptance">

                    <span class="avanor-terms-number">
                        01
                    </span>

                        <h2>
                            Acceptance of Terms
                        </h2>

                        <p>
                            By accessing or using an Avanor Capital website,
                            landing page or online service, you agree to these
                            Terms &amp; Conditions.
                        </p>

                        <p>
                            If you do not agree with these terms, you should
                            discontinue use of the website.
                        </p>

                    </section>


                    {{-- 02 --}}
                    <section
                        class="avanor-terms-section"
                        id="website-use">

                    <span class="avanor-terms-number">
                        02
                    </span>

                        <h2>
                            Use of the Website
                        </h2>

                        <p>
                            The Avanor Capital website is provided primarily
                            for informational purposes and to assist users
                            interested in real-estate opportunities in the
                            United Arab Emirates.
                        </p>

                        <p>
                            You agree not to misuse the website, interfere with
                            its operation, attempt unauthorised access, submit
                            fraudulent information or use its content for
                            unlawful purposes.
                        </p>

                    </section>


                    {{-- 03 --}}
                    <section
                        class="avanor-terms-section"
                        id="property-information">

                    <span class="avanor-terms-number">
                        03
                    </span>

                        <h2>
                            Property &amp; Project Information
                        </h2>

                        <p>
                            Property descriptions, project details, layouts,
                            amenities, sizes, specifications, payment plans,
                            handover dates and other information displayed on
                            the website are provided for general information.
                        </p>

                        <p>
                            Information may be obtained from developers,
                            authorised sources, marketing materials or other
                            third-party sources and may change without prior
                            notice.
                        </p>

                        <div class="avanor-terms-note">

                        <span>
                            IMPORTANT
                        </span>

                            <p>
                                Buyers should verify all material project and
                                property information before making a reservation,
                                signing an agreement or transferring funds.
                            </p>

                        </div>

                    </section>


                    {{-- 04 --}}
                    <section
                        class="avanor-terms-section"
                        id="prices">

                    <span class="avanor-terms-number">
                        04
                    </span>

                        <h2>
                            Prices &amp; Availability
                        </h2>

                        <p>
                            Property prices, starting prices, availability,
                            incentives and payment plans displayed on this
                            website are indicative unless expressly confirmed.
                        </p>

                        <p>
                            Pricing and inventory can change at any time based
                            on developer releases, unit availability, market
                            conditions or other factors.
                        </p>

                        <p>
                            The latest price and availability should always be
                            confirmed with Avanor Capital or the relevant
                            developer before proceeding.
                        </p>

                    </section>


                    {{-- 05 --}}
                    <section
                        class="avanor-terms-section"
                        id="visuals">

                    <span class="avanor-terms-number">
                        05
                    </span>

                        <h2>
                            Images, Renders &amp; Floor Plans
                        </h2>

                        <p>
                            Images, architectural renders, videos, floor plans,
                            maps and other visual materials may be provided for
                            illustrative purposes.
                        </p>

                        <p>
                            Final designs, finishes, landscaping, views,
                            dimensions and specifications may differ from
                            illustrations shown on the website.
                        </p>

                    </section>


                    {{-- 06 --}}
                    <section
                        class="avanor-terms-section"
                        id="developer">

                    <span class="avanor-terms-number">
                        06
                    </span>

                        <h2>
                            Developers &amp; Third-Party Projects
                        </h2>

                        <p>
                            Unless explicitly stated otherwise, Avanor Capital
                            is not the developer of properties promoted on its
                            website.
                        </p>

                        <p>
                            Developer names, trademarks, project names and
                            marketing materials remain the property of their
                            respective owners.
                        </p>

                        <p>
                            References to developers are provided to identify
                            the relevant real-estate project and do not imply
                            ownership of those brands by Avanor Capital.
                        </p>

                    </section>


                    {{-- 07 --}}
                    <section
                        class="avanor-terms-section"
                        id="investment">

                    <span class="avanor-terms-number">
                        07
                    </span>

                        <h2>
                            Investment Disclaimer
                        </h2>

                        <p>
                            Information presented on this website should not be
                            treated as financial, legal, tax or investment advice.
                        </p>

                        <p>
                            Property values, rental returns, capital appreciation
                            and investment performance are not guaranteed and
                            may vary according to market conditions and individual
                            circumstances.
                        </p>

                        <p>
                            Users should conduct their own due diligence and seek
                            appropriate professional advice where necessary
                            before making an investment decision.
                        </p>

                    </section>


                    {{-- 08 --}}
                    <section
                        class="avanor-terms-section"
                        id="enquiries">

                    <span class="avanor-terms-number">
                        08
                    </span>

                        <h2>
                            Enquiries &amp; Communication
                        </h2>

                        <p>
                            When you submit a property enquiry, request a brochure,
                            request pricing or provide your contact information,
                            you authorise Avanor Capital to contact you regarding
                            your enquiry.
                        </p>

                        <p>
                            Communication may take place by telephone, WhatsApp,
                            email or other reasonable communication channels,
                            subject to applicable requirements and your
                            communication preferences.
                        </p>

                    </section>


                    {{-- 09 --}}
                    <section
                        class="avanor-terms-section"
                        id="third-party">

                    <span class="avanor-terms-number">
                        09
                    </span>

                        <h2>
                            Third-Party Websites &amp; Services
                        </h2>

                        <p>
                            Our website may contain links or integrations relating
                            to maps, developers, social networks, analytics,
                            advertising platforms or other third-party services.
                        </p>

                        <p>
                            Avanor Capital does not control third-party websites
                            and is not responsible for their availability,
                            content, security or privacy practices.
                        </p>

                    </section>


                    {{-- 10 --}}
                    <section
                        class="avanor-terms-section"
                        id="intellectual-property">

                    <span class="avanor-terms-number">
                        10
                    </span>

                        <h2>
                            Intellectual Property
                        </h2>

                        <p>
                            Unless otherwise stated, website design, text,
                            branding, original graphics and other Avanor Capital
                            content may not be reproduced, distributed or used
                            commercially without appropriate permission.
                        </p>

                        <p>
                            Third-party trademarks, project imagery and developer
                            materials remain subject to the rights of their
                            respective owners.
                        </p>

                    </section>


                    {{-- 11 --}}
                    <section
                        class="avanor-terms-section"
                        id="liability">

                    <span class="avanor-terms-number">
                        11
                    </span>

                        <h2>
                            Limitation of Liability
                        </h2>

                        <p>
                            While reasonable efforts are made to provide accurate
                            and current information, Avanor Capital does not
                            warrant that all website content will always be
                            complete, error-free or immediately updated.
                        </p>

                        <p>
                            To the extent permitted by applicable law, Avanor
                            Capital will not be responsible for losses resulting
                            solely from reliance on outdated or unconfirmed
                            website information.
                        </p>

                    </section>


                    {{-- 12 --}}
                    <section
                        class="avanor-terms-section"
                        id="changes">

                    <span class="avanor-terms-number">
                        12
                    </span>

                        <h2>
                            Changes to These Terms
                        </h2>

                        <p>
                            Avanor Capital may update these Terms &amp; Conditions
                            from time to time to reflect changes to its website,
                            services, business operations or applicable
                            requirements.
                        </p>

                        <p>
                            The latest version will be published on this page
                            together with the updated date.
                        </p>

                    </section>


                    {{-- 13 --}}
                    <section
                        class="avanor-terms-section"
                        id="law">

                    <span class="avanor-terms-number">
                        13
                    </span>

                        <h2>
                            Governing Law
                        </h2>

                        <p>
                            These Terms &amp; Conditions are intended to be
                            governed by the applicable laws of the United Arab
                            Emirates, subject to any mandatory legal or
                            regulatory requirements that apply.
                        </p>

                    </section>


                    {{-- 14 --}}
                    <section
                        class="avanor-terms-section avanor-terms-contact"
                        id="contact">

                    <span class="avanor-terms-number">
                        14
                    </span>

                        <h2>
                            Have a Question?
                        </h2>

                        <p>
                            If you have a question about these Terms &amp;
                            Conditions or information displayed on an Avanor
                            Capital property page, contact our team.
                        </p>

                        <a
                            href="/"
                            class="avanor-terms-contact-btn">
                            CONTACT AVANOR CAPITAL
                        </a>

                    </section>

                </article>

            </div>

        </div>

    </section>

@endsection
