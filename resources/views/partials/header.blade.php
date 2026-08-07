<header class="th-header header-layout3">
    <div class="sticky-wrapper">
        <div class="menu-area">

            <div class="container">
                <div class="row align-items-center header-custom header-custom justify-content-between">

                    <div class="col-auto">
                        <div class="header-logo">
                            <a href="#">
                                <img   class="logo-white"  src="{{ asset('assets/img/' . (trim($__env->yieldContent('logo')) ?: 'logo-white2.svg')) }}" alt="Avanor">
                                <img class="logo-dark"         src="{{ asset('assets/img/' . (trim($__env->yieldContent('logo_secondary')) ?: 'logo-dark.svg')) }}"
                                alt="Avanor">

                            </a>
                        </div>
                    </div>

                    <div class="col-auto">
                        <nav class="main-menu d-none d-lg-inline-block">
                            <ul>
                                <li><a href="#">PROPERTIES</a>


                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">DEVELOPERS</a>

                                    <ul class="sub-menu">
                                        @foreach ($developers as $developer)
                                        <li>
                                            <a href="#">
                                                {{ $developer['name'] }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="#">COMMUNITIES</a></li>
                                <li><a href="#">ABOUT</a></li>
                                <li><a href="#">CONTACT</a></li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>