@php
    $formId = $formId ?? 'lead-form-' . uniqid();

    $propertyId = $propertyId ?? null;
    $developerId = $developerId ?? null;

    $heading = $heading ?? 'Get Property Details';

    $description = $description
        ?? '';

    $buttonText = $buttonText ?? 'Request Details';

    $source = $source ?? 'website';
@endphp


<div class="avanor-lead-form">

    <div class="avanor-lead-form-header">

        <span class="avanor-lead-kicker">
            PROPERTY ENQUIRY
        </span>

        <h3>
            {{ $heading }}
        </h3>

        <p>
            {{ $description }}
        </p>

    </div>


    @if (session('lead_success'))
        <div class="avanor-lead-success">
            {{ session('lead_success') }}
        </div>
    @endif


    <form
        id="{{ $formId }}"
        method="POST"
        action="{{ $action ?? route('leads.store') }}"
                class="avanor-lead-form-element"
    >

        @csrf


        {{-- Context --}}

        @if ($propertyId)
            <input
                type="hidden"
                name="property_id"
                value="{{ $propertyId }}"
            >
        @endif

        @if ($developerId)
            <input
                type="hidden"
                name="developer_id"
                value="{{ $developerId }}"
            >
        @endif


        <input
            type="hidden"
            name="source"
            value="{{ $source }}"
        >

        <input
            type="hidden"
            name="page_url"
            value="{{ url()->full() }}"
        >


        {{-- Campaign tracking --}}

        <input
            type="hidden"
            name="utm_source"
            value="{{ request('utm_source') }}"
        >

        <input
            type="hidden"
            name="utm_medium"
            value="{{ request('utm_medium') }}"
        >

        <input
            type="hidden"
            name="utm_campaign"
            value="{{ request('utm_campaign') }}"
        >

        <input
            type="hidden"
            name="utm_content"
            value="{{ request('utm_content') }}"
        >

        <input
            type="hidden"
            name="utm_term"
            value="{{ request('utm_term') }}"
        >

        <input
            type="hidden"
            name="gclid"
            value="{{ request('gclid') }}"
        >

        <input
            type="hidden"
            name="fbclid"
            value="{{ request('fbclid') }}"
        >


        {{-- Full Name --}}

        <div class="avanor-lead-field">

            <label for="{{ $formId }}-name">
                Full Name
            </label>

            <input
                type="text"
                id="{{ $formId }}-name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Enter your full name"
                autocomplete="name"
                required
            >

            @error('name')
                <span class="avanor-lead-error">
                    {{ $message }}
                </span>
            @enderror

        </div>


        {{-- Phone --}}

        <div class="avanor-lead-field">

            <label for="{{ $formId }}-phone">
                Phone / WhatsApp
            </label>

            <input
                type="tel"
                id="{{ $formId }}-phone"
                name="phone"
                value="{{ old('phone') }}"
                placeholder=""
                autocomplete="tel"
                required
            >



            @error('phone')
            <span class="avanor-lead-error">
            {{ $message }}
        </span>
            @enderror

        </div>


        {{-- Email --}}

        <div class="avanor-lead-field">

            <label for="{{ $formId }}-email">
                Email Address
            </label>

            <input
                type="email"
                id="{{ $formId }}-email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Enter your email address"
                autocomplete="email"
            >

            @error('email')
                <span class="avanor-lead-error">
                    {{ $message }}
                </span>
            @enderror

        </div>


        <button
            type="submit"
            class="avanor-lead-submit"
        >
            {{ strtoupper($buttonText) }}

{{--            <i class="far fa-arrow-right"></i>--}}

            <x-landing-icon name="arrow-right" />
        </button>


        <p class="avanor-lead-consent">

            By submitting this form, you agree to be contacted by
            Avanor Capital regarding this property and related real
            estate opportunities.

        </p>

    </form>

</div>
