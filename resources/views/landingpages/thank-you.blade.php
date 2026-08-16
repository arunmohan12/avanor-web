@extends('landingpages.layouts.landing')

@section('title', 'Thank You | Avanor')

@section('content')

<section class="landing-thankyou">

    <div class="landing-thankyou-content">

        <span class="landing-thankyou-eyebrow">
            ENQUIRY RECEIVED
        </span>

        <h1>
            Thank You
        </h1>

        <div class="landing-thankyou-line"></div>

        <p>
            Thank you for registering your interest.
            Our property advisor will contact you shortly with further details.
        </p>

        <div class="landing-thankyou-actions">

            <a
                href="{{ url()->previous() }}"
                class="landing-thankyou-btn">
                BACK TO PROPERTY
            </a>

            <a
                href="https://wa.me/YOUR_NUMBER"
                class="landing-thankyou-whatsapp"
                target="_blank"
                rel="noopener">
                <img
                    src="{{ asset('assets/img/whatsapp.svg') }}"
                    alt="">
                CHAT ON WHATSAPP
            </a>

        </div>

    </div>

</section>

@endsection