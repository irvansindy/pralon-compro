<!-- header area start  -->
<header>
    <div id="header-sticky" class="header__main header__demo b-bottom-2">
        {{-- <div id="header-sticky" class="header__main-2 header__shadow b-bottom"> --}}
        <div class="container header__main-container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="header__main-content-wrapper p-relative">
                        <div class="header__main-left">
                            <div class="header__logo ms-2">
                                <a href="{{ route('home') }}" class="logo-dark"><img src="{{ asset('assets/img/logo/pralon.png') }}"
                                        alt="logo-img"></a>
                            </div>
                            {{-- <div class="area-separator d-none d-lg-inline-flex"></div> --}}
                        </div>
                        <div class="main-menu main-menu1 d-none d-xl-block ms-auto">
                            <nav id="mobile-menu" style="display: block;">
                                <ul class="justify-content-center" style="margin-bottom: 0 !important;">
                                    <li class="menu-item-has-children">
                                        <a href="{{ route('home') }}">BERANDA</a>
                                        {{-- <ul class="sub-menu">
                                            <li><a href="plumbing.html">Plumbing</a></li>
                                            <li><a href="air-condition.html">Air Condition</a></li>
                                            <li><a href="solar.html">Solar Energy</a></li>
                                            <li><a href="ecommerce.html">Plumbing Shop</a></li>
                                        </ul> --}}
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="{{ route('about-us') }}">TENTANG KAMI</a>
                                        {{-- <ul class="sub-menu">
                                            <li><a href="about.html">About</a></li>
                                            <li><a href="about-v2.html">About-v2</a></li>
                                        </ul> --}}
                                    </li>
                                    <li class="has-dropdown has-mega-menu">
                                        <a href="{{ route('product') }}">PRODUK</a>
                                        {{-- <ul class="mega-menu">
                                            <li class="mega-menu-item">
                                                <ul>
                                                    <li><a href="elements-accordion.html">Accordion</a></li>
                                                    <li><a href="elements-brand.html">Brand</a></li>
                                                    <li><a href="elements-buttons.html">Buttons</a></li>
                                                    <li><a href="elements-social-share.html">Social Share</a></li>
                                                    <li><a href="elements-blog.html">Blog</a></li>
                                                    <li><a href="elements-blog-grid.html">Blog Grid</a></li>
                                                    <li><a href="elements-counter.html">Counter</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-item">
                                                <ul>
                                                    <li><a href="elements-service.html">Service</a></li>
                                                    <li><a href="elements-service-grid.html">Service Grid</a></li>
                                                    <li><a href="elements-portfolio.html">Portfolio</a></li>
                                                    <li><a href="elements-portfolio-grid.html">Portfolio Grid</a>
                                                    </li>
                                                    <li><a href="elements-video.html">Video</a></li>
                                                    <li><a href="elements-heading.html">Section-Title</a></li>
                                                    <li><a href="elements-testimonial.html">Testimonial</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-item">
                                                <ul>
                                                    <li><a href="elements-contact.html">Contact</a></li>
                                                    <li><a href="elements-contact-form.html">Contact Form</a></li>
                                                    <li><a href="elements-team.html">Team</a></li>
                                                    <li><a href="elements-pricing.html">Pricing</a></li>
                                                    <li><a href="elements-progressbar.html">Progressbar</a></li>
                                                    <li><a href="elements-breadcrumb.html">Breadcrumb</a></li>
                                                    <li><a href="elements-footer.html">Footer</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-item">
                                                <ul>
                                                    <li><a href="elements-error.html">404</a></li>
                                                    <li><a href="elements-cta.html">Call To Action</a></li>
                                                    <li><a href="elements-sign-in.html">Sign In</a></li>
                                                    <li><a href="elements-sign-up.html">Sign Up</a></li>
                                                    <li><a href="elements-reset-password.html">Reset Password</a>
                                                    </li>
                                                    <li><a href="policy.html">Privacy &amp; Policy</a></li>
                                                    <li><a href="terms.html">Terms &amp; Condition</a></li>
                                                </ul>
                                            </li>
                                        </ul> --}}
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="{{ route('news') }}">BERITA</a>
                                        {{-- <ul class="sub-menu">
                                            <li class="menu-item-has-children">
                                                <a href="portfolio-classic.html">Portfolio</a>
                                                <ul class="sub-menu">
                                                    <li><a href="portfolio-grid.html">Portfolio Grid</a></li>
                                                    <li><a href="portfolio-classic.html">Portfolio Classic</a></li>
                                                    <li><a href="portfolio-list.html">Portfolio List</a></li>
                                                    <li><a href="portfolio-Masonry.html">Portfolio Masonry</a></li>
                                                    <li>
                                                        <a href="portfolio-details.html">Portfolio Details</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children">
                                                <a href="services.html">Services</a>
                                                <ul class="sub-menu">
                                                    <li><a href="services.html">Services</a></li>
                                                    <li><a href="services-v2.html">Services-02</a></li>
                                                    <li><a href="service-details.html">Service Details</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children">
                                                <a href="team.html">Team</a>
                                                <ul class="sub-menu">
                                                    <li><a href="team.html">Team</a></li>
                                                    <li>
                                                        <a href="team-details.html">Team Details</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="shop.html">Shop</a></li>
                                            <li>
                                                <a href="shop-details.html">Shop Details</a>
                                            </li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                            <li><a href="cart.html">Cart</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                            <li><a href="pricing-plan.html">Pricing Plan</a></li>
                                            <li><a href="faq.html">FAQ</a></li>
                                            <li><a href="error-404.html">Error 404</a></li>
                                        </ul> --}}
                                    </li>
                                    {{-- <li class="menu-item-has-children">
                                        <a href="blog-classic.html">Blog</a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-grid.html">Blog Grid</a></li>
                                            <li><a href="blog-classic.html">Blog Classic</a></li>
                                            <li><a href="blog-list.html">Blog List</a></li>
                                            <li><a href="blog-masonry.html">Blog Masonry</a></li>
                                            <li>
                                                <a href="blog-details.html">Blog Details</a>
                                            </li>
                                        </ul>
                                    </li> --}}
                                    <li><a href="{{ route('contact-us') }}">HUBUNGI KAMI</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header__main-right ms-auto">
                            {{-- <div class="purchase__now d-none d-sm-inline-flex">
                                <div class="meta-item">
                                    <a href="https://themeforest.net/item/dofix-plumbing-repair-store-html5-template/48035083"
                                        target="_blank" class="primary-btn hover-white">Purchase Now
                                        <span class="icon__box">
                                            <img class="icon__first" src="assets/img/icon/arrow-white.webp"
                                                alt="image not found">
                                            <img class="icon__second" src="assets/img/icon/arrow-black.webp"
                                                alt="image not found">
                                        </span>
                                    </a>
                                </div>
                            </div> --}}
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
