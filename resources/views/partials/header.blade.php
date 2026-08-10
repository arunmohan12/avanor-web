@include('partials.mobile-menu')


<header class="th-header header-layout3">
    <div class="sticky-wrapper">
        <div class="menu-area">

            <div class="container">
                <div class="row align-items-center header-custom header-custom justify-content-between">

                    <div class="col-auto">
                        <div class="header-logo">
                            <a href="{{ url('/') }}">

                                {{-- Primary Logo --}}
                                <img
                                    class="logo-white"
                                    src="{{ asset(
        'assets/img/' .
        (trim($__env->yieldContent('logo')) ?: 'logo-white2.svg')
    ) }}"
                                    alt="Avanor">

                                {{-- Secondary / Sticky Logo --}}
                                <img
                                    class="logo-dark"
                                    src="{{ asset(
        'assets/img/' .
        (trim($__env->yieldContent('logo_secondary')) ?: 'logo-dark.svg')
    ) }}"
                                    alt="Avanor">

                            </a>
                        </div>
                    </div>

                    <div class="col-auto">
                        <nav class="main-menu d-none d-lg-inline-block">

                            <ul>

                                @foreach ($navigation as $menu)

                                @php
                                $hasChildren = !empty($menu['children']);

                                $href = $menu['route_name']
                                ? route($menu['route_name'])
                                : ($menu['url'] ?: 'javascript:void(0)');
                                @endphp

                                <li class="{{ $hasChildren ? 'menu-item-has-children' : '' }}">

                                    <a href="{{ $href }}">
                                        {{ strtoupper($menu['label']) }}
                                    </a>

                                    @if ($hasChildren)

                                    <ul class="sub-menu">

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

                        {{-- Mobile / Tablet Menu Button --}}
            <button
                type="button"
                class="avanor-mobile-menu-open d-lg-none"
                id="avanorMobileMenuOpen"
                aria-label="Open menu"
            >
                <i class="far fa-bars"></i>
            </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>