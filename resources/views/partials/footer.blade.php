<footer class="avanor-footer">

    <div class="container">

        <div class="avanor-footer-grid">

            {{-- Brand --}}
            <div class="avanor-footer-brand">

                <a href="{{ url('/') }}" class="avanor-footer-logo">
                    <img
                        src="{{ asset('assets/img/logo-white2.svg') }}"
                        alt="Avanor Capital">
                </a>

                <p>
                    Premium properties, trusted developers and curated
                    opportunities across the UAE.
                </p>

                @php
                $socials = [
                'facebook' => 'fab fa-facebook-f',
                'instagram' => 'fab fa-instagram',
                'linkedin' => 'fab fa-linkedin-in',
                'youtube' => 'fab fa-youtube',
                'x' => 'fab fa-twitter',
                ];
                @endphp

                <div class="avanor-footer-socials">

                    @foreach ($socials as $platform => $icon)

                    @if (filled($siteSettings[$platform] ?? null))
    <a
        href="{{ $siteSettings[$platform] }}"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="{{ ucfirst($platform) }}">
        <i class="{{ $icon }}"></i>
    </a>
@endif

                    @endforeach

                </div>

            </div>


            {{-- Explore --}}
            <div class="avanor-footer-column">

                <h4>Explore</h4>

                <ul class="avanor-footer-links">
                    <li>
                        <a href="{{ route('properties.index') }}">Properties</a>
                    </li>

                    <li>
                        <a href="{{ route('developer.index') }}">Developers</a>
                    </li>

                    <li>
                        <a href="{{ route('communities.index') }}">Communities</a>
                    </li>
                    <li><a href="javascript:void(0)">Off-Plan</a></li>
                </ul>

            </div>


            {{-- Discover --}}
            <div class="avanor-footer-column">

                <h4>Discover</h4>

                <ul class="avanor-footer-links">
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="javascript:void(0)">Projects</a></li>
                    <li><a href="{{ route('blogs') }}">UAE Insights</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>

            </div>


            {{-- Contact --}}
            <div class="avanor-footer-column avanor-footer-contact-column">

                <h4>Get In Touch</h4>

                <ul class="avanor-footer-contact">

                    <li>
                        <i class="far fa-map-marker-alt"></i>

                        <span>
                            {{ $siteSettings['address'] ?? '' }}
                        </span>
                    </li>

                    <li>
                        <i class="far fa-phone"></i>

                        @if (!empty($siteSettings['phone']))
                        <a href="tel:{{ preg_replace('/\s+/', '', $siteSettings['phone']) }}">
                            {{ $siteSettings['phone'] }}
                        </a>
                        @endif
                    </li>

                    <li>
                        <i class="far fa-envelope"></i>

                        @if (!empty($siteSettings['email']))
                        <a href="mailto:{{ $siteSettings['email'] }}">
                            {{ $siteSettings['email'] }}
                        </a>
                        @endif
                    </li>

                </ul>



            </div>

        </div>

    </div>


    {{-- Bottom --}}
    <div class="avanor-footer-bottom">

        <div class="container">

            <div class="avanor-footer-bottom-inner">

                <p>
                    © {{ date('Y') }} Avanor Capital. All rights reserved.
                </p>

                <div class="avanor-footer-legal">
                    <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                    <a href="{{ route('terms-and-conditions') }}">
                        Terms & Conditions
                    </a>
                </div>

            </div>

        </div>

    </div>

</footer>