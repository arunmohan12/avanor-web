<div class="avanor-mobile-menu" id="avanorMobileMenu">

    <div class="avanor-mobile-menu-panel">

        <div class="avanor-mobile-menu-top">

            <a href="{{ url('/') }}" class="avanor-mobile-menu-logo">
                <img
                    src="{{ asset('assets/img/logo-dark.svg') }}"
                    alt="Avanor Capital"
                >
            </a>

            <button
                type="button"
                class="avanor-mobile-menu-close"
                id="avanorMobileMenuClose"
                aria-label="Close menu"
            >
                <i class="far fa-times"></i>
            </button>

        </div>


        <nav class="avanor-mobile-nav">

            <ul>

                @foreach ($navigation as $menu)

                    @php
                        $hasChildren = !empty($menu['children']);

                        $menuHref = $menu['route_name']
                            ? route($menu['route_name'])
                            : ($menu['url'] ?: 'javascript:void(0)');
                    @endphp

                    <li class="{{ $hasChildren ? 'has-children' : '' }}">

                        <div class="avanor-mobile-menu-row">

                            <a href="{{ $menuHref }}">
                                {{ strtoupper($menu['label']) }}
                            </a>

                            @if ($hasChildren)
                                <button
                                    type="button"
                                    class="avanor-mobile-submenu-toggle"
                                    aria-label="Toggle submenu"
                                >
                                    <i class="far fa-chevron-down"></i>
                                </button>
                            @endif

                        </div>


                        @if ($hasChildren)

                            <ul class="avanor-mobile-submenu">

                                @foreach ($menu['children'] as $child)

                                    @php
                                        $childHref = $child['route_name']
                                            ? route($child['route_name'])
                                            : ($child['url'] ?: 'javascript:void(0)');
                                    @endphp

                                    <li>
                                        <a href="{{ $childHref }}">
                                            {{ $child['label'] }}
                                        </a>
                                    </li>

                                @endforeach

                            </ul>

                        @endif

                    </li>

                @endforeach

            </ul>

        </nav>


        <div class="avanor-mobile-menu-contact">

            @if (!empty($siteSettings['phone']))
                <a href="tel:{{ preg_replace('/\s+/', '', $siteSettings['phone']) }}">
                    <i class="far fa-phone"></i>
                    <span>{{ $siteSettings['phone'] }}</span>
                </a>
            @endif

            @if (!empty($siteSettings['email']))
                <a href="mailto:{{ $siteSettings['email'] }}">
                    <i class="far fa-envelope"></i>
                    <span>{{ $siteSettings['email'] }}</span>
                </a>
            @endif

        </div>

    </div>

</div>