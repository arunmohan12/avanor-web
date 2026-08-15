@extends('layouts.app')

@section('title', 'Property Enquiry | Avanor Capital')
@section('logo', 'logo-dark.svg')

@section('content')

<section class="space-top space-bottom">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-5">

                @include('partials.lead-form', [
                    'heading' => 'Speak With a Property Advisor',
                    'description' => 'Tell us how we can help and one of our property advisors will contact you shortly.',
                    'buttonText' => 'Submit Enquiry',
                    'source' => 'standalone-form',
                ])

            </div>

        </div>

    </div>

</section>

@endsection