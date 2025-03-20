<!-- header area start  -->
<header>
    <div id="header-sticky" class="header__main header__demo b-bottom-2">
        {{-- <div id="header-sticky" class="header__main-2 header__shadow b-bottom"> --}}
        <div class="container header__main-container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="header__main-content-wrapper p-relative">
                        <div class="header__main-left">
                            <div class="header__logo ms-5">
                                <a href="{{ route('home') }}" class="logo-dark"><img src="{{ asset('assets/img/logo/pralon.png') }}"
                                        alt="logo-img"></a>
                            </div>
                            {{-- <div class="area-separator d-none d-lg-inline-flex"></div> --}}
                        </div>
                        <div class="main-menu main-menu1 d-none d-xl-block ms-auto">
                            <nav id="mobile-menu" style="display: block;">
                                <ul class="justify-content-center" style="margin-bottom: 0 !important;">
                                    <li class="menu-item-has-children">
                                        <a href="{{ route('home') }}" class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">BERANDA</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="{{ route('about-us') }}" class="{{ Route::currentRouteName() == 'about-us' ? 'active' : '' }}">TENTANG KAMI</a>
                                    </li>
                                    <li class="has-dropdown has-mega-menu">
                                        <a href="{{ route('product') }}" class="{{ Route::currentRouteName() == 'product' ? 'active' : '' }}">PRODUK</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="{{ route('news') }}" class="{{ Route::currentRouteName() == 'news' ? 'active' : '' }}">BERITA</a>
                                        
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="{{ route('contact-us') }}" class="{{ Route::currentRouteName() == 'contact-us' ? 'active' : '' }}">HUBUNGI KAMI</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header__main-right ms-auto">
                            <button class="side-toggle d-xl-none">
                                <span class="menu__bar">
                                    <span class="bar-icon">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-area-end -->
