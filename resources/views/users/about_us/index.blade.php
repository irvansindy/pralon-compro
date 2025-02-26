@extends('layouts.users.app', ['title' => 'About Us'])

@section('content')
    @include('layouts.users.navbar')
    @include('layouts.users.sidebar')
    <div class="mouseCursor cursor-outer"></div>
    <div class="mouseCursor cursor-inner"><span>Drag</span></div>
    <!-- Add your site or application content here -->
    <main>

        <div class="adjust-header-space bg-common-white"></div>

        <!-- page title area start  -->
        <section class="page-title-area-2 breadcrumb-spacing bg-theme-4 section-spacing">
            <div class="d-none" data-background="d-none"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-9">
                        <div class="page-title-wrapper-2 text-center">
                            <h1 class="page__title-2 mb-15">Tentang Kami</h1>
                            <div class="breadcrumb-menu-2 d-flex justify-content-center">
                                <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                                    <ul class="trail-items-2">
                                        <li class="trail-item-2 trail-begin"><a href="{{ route('home') }}"><span>Home</span></a></li>
                                        <li class="trail-item-2 trail-end"><span>Tentang Kami</span></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area start  -->

        <!-- about area start  -->
        <section class="df-about5__area section-spacing">
            <div class="container">
                <div class="row g-5 gy-50 align-items-center wow fadeInUp" data-wow-delay=".4s">
                    <div class=" col-xxl-6 col-xl-6 col-lg-6 order-lg-0 order-1">
                        <div class="df-video__box style-2">
                            {{-- <img src="{{ asset('assets/img/pralon/youtube_thumbnail.jpg') }}" id="thumbnail_video" alt="image not found"> --}}
                            <img src="" id="thumbnail_video" alt="image not found">
                            <div class="df-video__play-btn pos-center">
                                {{-- <a href="https://www.youtube.com/watch?v=bOXO3_AvfFY" class="play-btn popup-video" id="link_video">
                                    <i class="icon-008-play-button"></i>
                                </a> --}}
                                <a href="#" class="play-btn popup-video" id="link_video">
                                    <i class="icon-008-play-button"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class=" col-xxl-6 col-xl-6 col-lg-5 order-lg-1 order-0">
                        <div class="df-about3__content">
                            <div class="section__title-wrapper">
                                <span class="section__subtitle bg-lighter" id="history_title"></span>
                                <h2 class="section__title" id="history_subtitle"></h2>
                            </div>
                            <p class="mt-35 mb-35" id="history_desc"></p>
                            {{-- <div class="df-about3__counter-wrap mb-40">
                                <div class="df-about3__counter-box">
                                    <div class="df-about3__counter-number-box">
                                        <h2 class="df-about3__counter-number"><span class="odometer" data-count="13"></span>
                                        </h2>
                                    </div>
                                    <p class="df-about3__counter-text">Agen Pralon <br>Jabodetabek</p>
                                </div>
                                <div class="df-about3__counter-box">
                                    <div class="df-about3__counter-number-box">
                                        <h2 class="df-about3__counter-number"><span class="odometer" data-count="34"></span>
                                        </h2>
                                    </div>
                                    <p class="df-about3__counter-text">Agen Pralon <br>Luar Jabodetabek</p>
                                </div>
                            </div>
                            <div class="df-about3__button">
                                <a href="service-details.html" class="primary-btn hover-white">Selengkapnya
                                    <span class="icon__box">
                                        <img class="icon__first" src="assets/img/icon/arrow-white.webp"
                                            alt="image not found">
                                        <img class="icon__second" src="assets/img/icon/arrow-black.webp"
                                            alt="image not found">
                                    </span>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about area end  -->

        <!-- why reason start  -->
        <section class="df-benifits__area section-spacing bg-theme-4">
            <div class="container">
                <div class="row align-items-center justify-content-between g-50 wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-xl-7">
                        <div class="section__title-wrapper section-title-spacing">
                            <span class="section__subtitle bg-lighter" id="why_title"></span>
                            <h2 class="section__title" id="why_subtitle"></h2>
                            <p class="mt-35 mb-35" id="why_desc"></p>
                        </div>
                        <div class="df-benifits__wrapper">
                            <div class="row justify-content-between" id="pralon_point_plus_list">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="df-benifits__thumb">
                            <img src="{{ asset('assets/img/pralon/why_pralon.jpg') }}" alt="image not found">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- why reason end  -->

        <!-- visi misi start -->
        <section class="df-system__area">
            <div class="container">
                <div class="df-system__wrapper section-spacing">
                    <div class="df-system__thumb" id="visi_background" data-background="">
                    </div>
                    <div class="df-loading-bar__wrapper">
                        <div class="row">
                            <div class="col-xl-6 col-lg-8">
                                <div class="labels" id="list_visi_misi">
                                    <div class="df-system__content">
                                        <div class="section__title-wrapper mb-30">
                                            <span class="section__subtitle bg-lighter">VISI</span>
                                            <h2 class="section__title">Visi Pralon</h2>
                                        </div>
                                        <p id="visi_text"></p>
                                    </div>
                                    <div class="df-system__content">
                                        <div class="section__title-wrapper mb-30">
                                            <span class="section__subtitle bg-lighter">MISI</span>
                                            <h2 class="section__title">Misi Pralon</h2>
                                        </div>
                                        <ol style="font-size: 16px; !important" id="list_misi">
                                            
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="df-timeline__slider">
                            <div class="timeline__slider-nav timeline-slider-arrow"></div>
                            <div class="loading-bar line-bar" id="indicator_visi_misi">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- visi misi end -->
        <!-- pralon value -->
        <section class="df-requirement__area section-spacing">
            <div class="container">
                <div class="row gy-5 wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-lg-5 col-md-6">
                        <div class="section__title-wrapper">
                            <h2 class="section__title">Pralon Values</h2>
                        </div>
                        <div class="df-requirement__button-wrapper">
                            <a href="{{ route('contact-us') }}" class="primary-btn hover-white">Contact Us
                                <span class="icon__box">
                                    <img class="icon__first" src="{{ asset('assets/img/icon/arrow-white.webp') }}"
                                        alt="image not found">
                                    <img class="icon__second" src="{{ asset('assets/img/icon/arrow-black.webp') }}"
                                        alt="image not found">
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="df-requirement__feature-list">
                            <ul class="list_value_pralon">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- brands area start  -->
        <div class="brand__area section-spacing">
            <div class="container">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="margin-bottom: 60px">
                    <div class="section__title-wrapper">
                        <span class="section__subtitle bg-lighter">Sertifikasi </span>
                        <h2 class="section__title">Sertifikasi & Penghargaan</h2>
                    </div>
                </div>
                <div class="brands__wrapper wow fadeInUp mt-6" data-wow-delay=".3s">
                    <div class="swiper brand__slider slider_certificates">
                        <div class="swiper-wrapper certificate_carousel_icon">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- brands area end  -->
    </main>
    <!-- footer-area-start -->
    @include('layouts.users.footer')
@endsection
@push('js')
    @include('users.about_us.abous_us_js')
@endpush