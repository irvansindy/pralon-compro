@extends('layouts.users.app', ['title' => 'Hubungi Kami'])
@section('content')
    @include('layouts.users.navbar')
    @include('layouts.users.sidebar')
    <div class="mouseCursor cursor-outer"></div>
    <div class="mouseCursor cursor-inner"><span>Drag</span></div>

    <main>

        <div class="adjust-header-space bg-common-white"></div>

        <!-- contact area start  -->
        <section class="df-services__area section-spacing p-relative x-clip">
            {{-- <div class="circle-2"></div>
            <div class="circle-3"></div> --}}
            <div class="container-fluid">
                <div class="row justify-content-center section-title-spacing wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-xl-8">
                        <div class="section__title-wrapper text-center">
                            <span class="section__subtitle bg-lighter">Hubungi Kami</span>
                            <h2 class="section__title">Terhubung Bersama Kami</h2>
                        </div>
                    </div>
                </div>
                <!-- blog style 02 start  -->
                <div class="df-blog4__wrapper">
                    <div class="row g-5 row-cols-md-2 row-cols-1 wow fadeInUp" id="list_contact_us" data-wow-delay=".5s"
                        style="padding-left: 25px; padding-right: 25px;">
                        <div class="col">
                            <div class="df-blog4__box">
                                <div class="df-blog4__thumb">
                                    <a href="blog-details.html"><img src="assets/img/blog/blog-18.webp"
                                            alt="image not found"></a>
                                </div>
                                <div class="df-blog4__content">
                                    <h3 class="df-blog4__title">
                                        <a href="#">Kantor Pusat</a>
                                    </h3>
                                    <p>Head office Synergy Building #08-08 Jl. Jalur Sutera Barat 17, Alam Sutera Serpong
                                        Tangerang 15143 Indonesia</p>
                                    <div class="row row-cols-3 py-2" style="font-size: 12px;">
                                        <div class="col">
                                            <span>
                                                Email :
                                                <br>
                                                <a href="mailto:info@pralon.com">info@pralon.com</a>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <span>
                                                Telp :
                                                <br>
                                                (021) 304 38808
                                            </span>

                                        </div>
                                        <div class="col">
                                            <span>
                                                Fax :
                                                <br>
                                                (021) 304 38801
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="df-blog4__box">
                                <div class="df-blog4__thumb">
                                    <a href="blog-details.html"><img src="assets/img/blog/blog-18.webp"
                                            alt="image not found"></a>
                                </div>
                                <div class="df-blog4__content">
                                    <h3 class="df-blog4__title">
                                        <a href="#">Kantor Pusat</a>
                                    </h3>
                                    <p>Head office Synergy Building #08-08 Jl. Jalur Sutera Barat 17, Alam Sutera Serpong
                                        Tangerang 15143 Indonesia</p>
                                    <div class="row row-cols-3 py-2" style="font-size: 12px;">
                                        <div class="col">
                                            <span>
                                                Email :
                                                <br>
                                                <a href="mailto:info@pralon.com">info@pralon.com</a>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <span>
                                                Telp :
                                                <br>
                                                (021) 304 38808
                                            </span>

                                        </div>
                                        <div class="col">
                                            <span>
                                                Fax :
                                                <br>
                                                (021) 304 38801
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="df-blog4__box">
                                <div class="df-blog4__thumb">
                                    <a href="blog-details.html"><img src="assets/img/blog/blog-18.webp"
                                            alt="image not found"></a>
                                </div>
                                <div class="df-blog4__content">
                                    <h3 class="df-blog4__title">
                                        <a href="#">Kantor Pusat</a>
                                    </h3>
                                    <p>Head office Synergy Building #08-08 Jl. Jalur Sutera Barat 17, Alam Sutera Serpong
                                        Tangerang 15143 Indonesia</p>
                                    <div class="row row-cols-3 py-2" style="font-size: 12px;">
                                        <div class="col">
                                            <span>
                                                Email :
                                                <br>
                                                <a href="mailto:info@pralon.com">info@pralon.com</a>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <span>
                                                Telp :
                                                <br>
                                                (021) 304 38808
                                            </span>

                                        </div>
                                        <div class="col">
                                            <span>
                                                Fax :
                                                <br>
                                                (021) 304 38801
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- blog style 02 end  -->
                <div class="df-booking2__form-wrapper section-spacing-top">
                    <div class="df-booking__video">
                        <img src="{{ asset('assets/img/pralon/contact/Head Office.jpg') }}" alt="image not found">
                        {{-- <div class="df-video__play-btn pos-center">
                            <a href="https://www.youtube.com/watch?v=0pZBJ7aJNy0" class="play-btn popup-video">
                                <i class="icon-008-play-button"></i>
                            </a>
                        </div> --}}
                    </div>
                    <div class="df-booking2__form">
                        <form action="#">
                            <div class="row gx-5">
                                <div class="col-md-6">
                                    <div class="df-input-field">
                                        <input type="text" id="name" name="name" placeholder="Nama Lengkap">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="df-input-field">
                                        <input type="text" id="email" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="df-input-field">
                                        <input type="text" id="number" name="number" placeholder="Nomor Handhpone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="df-input-field">
                                        <select name="service" id="service">
                                            <option value="penjualan">Penjualan</option>
                                            <option value="informasi produk">Informasi Produk</option>
                                            <option value="karir">Karir</option>
                                            <option value="kerjasama_dan_sponsorship">Kerjasama & Sponsorship</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="df-input-field">
                                        <textarea id="message" name="message" placeholder="ketik pesan disini..."></textarea>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="df-booking2__form-btn mt-0">
                                        <button type="submit" class="primary-btn hover-white">kirim pesan
                                            <span class="icon__box">
                                                <img class="icon__first" src="assets/img/icon/arrow-white.webp"
                                                    alt="image not found">
                                                <img class="icon__second" src="assets/img/icon/arrow-black.webp"
                                                    alt="image not found">
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="df__map p-relative section-spacing-top">
                <div class="df__google-map mapouter">
                    <div class="gmap_canvas">
                        <iframe width="1920" height="580" id="gmap_canvas"
                            src="https://maps.google.com/maps?q=Pralon.+PT%2C+Alam+Sutera%2C+Synergy%2C+Jl.+Jalur+Sutera+Bar.+No.17%2C+RT.002%2FRW.003%2C+East+Panunggangan%2C+Pinang%2C+Tangerang+City%2C+Banten+15143&t=k&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                        </iframe>
                        <a href="https://textcaseconvert.com"></a>
                        <br>
                        <a href="https://www.tabclocktab.com"></a><br>
                        <style>
                            .mapouter {
                                position: relative;
                                text-align: right;
                                height: 580px;
                                width: 1920px;
                            }
                        </style><a href="https://www.ongooglemaps.com">adding google map to website</a>
                        <style>
                            .gmap_canvas {
                                overflow: hidden;
                                background: none !important;
                                height: 580px;
                                width: 1920px;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact area end  -->

    </main>

    @include('layouts.users.footer')
@endsection
@push('js')
    @include('users.contact_us.contact_us_js')
@endpush
