@extends('layouts.users.app', ['title' => 'Beranda'])

@section('content')
    @include('layouts.users.navbar')
    @include('layouts.users.sidebar')
    <div class="mouseCursor cursor-outer"></div>
    <div class="mouseCursor cursor-inner"><span>Drag</span></div>
    <main>
        {{-- <div class="adjust-header-space bg-common-white"></div> --}}
        <!-- hero area start  -->
        <section class="hero__area p-relative section-spacing bg-theme-1 hero__area-3 fix">
            <div class="container container-big">
                <div class="hero__content p-relative">
                    <div class="hero__title-wrap">
                        <p class="hero__subtitle xsmall uppercase lh-1 wow fadeInUp" data-wow-delay=".3s">Selamat datang
                        </p>
                        <h1 class="hero__title wow fadeInUp" data-wow-delay=".5s">Kualitas Teruji <br> Sistem <br> Perpipaan
                        </h1>
                    </div>
                    <p class="hero__text wow fadeInUp" data-wow-delay=".7s"
                        style="text-align: justify;
text-justify: distribute;
text-align-last: left;">Selama 62 tahun,
                        Pralon telah berkontribusi dalam mendistribusikan air bersih dan air buangan ke seluruh pelosok
                        Indonesia. Dengan kualitas yang teruji dan terbukti, produk pipa dan aksesoris Pralon terus
                        berkembang, mengikuti kemajuan industri pipanisasi di Indonesia.
                        Komitmen kami tak hanya pada inovasi dan ketahanan produk, tetapi juga pada kelestarian lingkungan,
                        dengan standar Green Product Indonesia sebagai bentuk tanggung jawab terhadap masa depan yang lebih
                        hijau.</p>
                    <div class="hero__button wow fadeInUp" data-wow-delay=".9s">
                        <a href="#" class="primary-btn hover-white">Selengkapnya
                            <span class="icon__box">
                                <img class="icon__first" src="assets/img/icon/arrow-white.webp" alt="image not found">
                                <img class="icon__second" src="assets/img/icon/arrow-black.webp" alt="image not found">
                            </span>
                        </a>
                    </div>
                    <div class="hero__video-wrapper">
                        <div class="video-info">
                            <div class="video-intro add_class">
                                <input id="video_check" type="checkbox">
                                <div class="intro-title">
                                    <h4 class="video-title">Watch <span>video intro</span></h4>
                                    <h4 class="video-title close-video-title p-relative z-index-5">Close <span>video
                                            intro</span></h4>
                                </div>
                                <div class="video">
                                    <video src="{{ asset('assets/video/hero_video.MOV') }}" loop muted autoplay
                                        playsinline></video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__img">
                <span class="hero__img-overlay"></span>
                <img src="{{ asset('assets/img/pralon/home_cover.jpg') }}" alt="image not found">
            </div>
        </section>
        <!-- hero area end  -->

        <!-- product list start  -->
        <div class="services__area section-spacing">
            <div class="container">
                <div class="row justify-content-center section-title-spacing mb-40 wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-xl-8">
                        <div class="section__title-wrapper text-center">
                            <span class="section__subtitle bg-lighter">PRODUK</span>
                            <h2 class="section__title">Produk Kami</h2>
                        </div>
                    </div>
                </div>
                <div class="swiper services__slider">
                    <div class="swiper-wrapper" id="list_product">

                    </div>
                </div>
                <div class="services__slider-pagination df__pagination mt-60 justify-content-center wow fadeInUp"
                    data-wow-delay=".3s"></div>
            </div>
        </div>
        <!-- product list end  -->

        <!-- about area start  -->
        <section class="df-about__area section-spacing bg-theme-4">
            <div class="container">
                <div class="row g-5 gy-50 align-items-center wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-lg-6">
                        <div class="df-about__content ">
                            <div class="section__title-wrapper">
                                <span class="section__subtitle bg-lighter">TENTANG KAMI</span>
                                <h2 class="section__title">Berdiri Sejak 1963</h2>
                            </div>
                            <p class="mt-35 mb-35">Pralon adalah merek dagang pipa uPVC berkualitas tinggi yang diproduksi
                                oleh PT Pralon. Sejak 1963, Pralon dikenal sebagai pelopor industri pipa uPVC di Indonesia.
                                Dengan dukungan teknologi mutakhir dan standar produksi yang tinggi, PT Pralon terus
                                menghadirkan produk-produk berkualitas terbaik yang tahan lama, andal, dan inovatif untuk
                                memenuhi kebutuhan berbagai sektor.</p>
                            <div class="df-about__feature-list mb-45">
                                <ul>
                                    <li>
                                        <span class="list-icon">
                                            <i class="icon-058-check"></i>
                                        </span>
                                        <p style="margin-bottom: 0 !important;">Bebas Timbal.</p>
                                    </li>
                                    <li>
                                        <span class="list-icon">
                                            <i class="icon-058-check"></i>
                                        </span>
                                        <p style="margin-bottom: 0 !important;">Ramah Lingkungan.</p>
                                    </li>
                                    <li>
                                        <span class="list-icon">
                                            <i class="icon-058-check"></i>
                                        </span>
                                        <p style="margin-bottom: 0 !important;">Kuat dan Berkualitas.</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="df-about__button">
                                <a href="{{ route('about-us') }}" class="primary-btn hover-white">Selengkapnya
                                    <span class="icon__box">
                                        <img class="icon__first" src="assets/img/icon/arrow-white.webp"
                                            alt="image not found">
                                        <img class="icon__second" src="assets/img/icon/arrow-black.webp"
                                            alt="image not found">
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="df-video__box">
                            {{-- youtube_thumbnail.jpg --}}
                            <img src="{{ asset('assets/img/pralon/youtube_thumbnail.jpg') }}" alt="image not found">
                            <div class="df-about__play-btn pos-center">
                                <a href="https://www.youtube.com/watch?v=bOXO3_AvfFY" class="play-btn popup-video"><i
                                        class="icon-008-play-button"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about area end  -->

        <!-- portfolio area start  -->
        <section class="df-portfolio__area section-spacing">
            <div class="container">
                <div class="row align-items-end section-title-spacing g-5 wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-lg-8 col-md-8">
                        <div class="section__title-wrapper">
                            <span class="section__subtitle bg-lighter">PROJEK KAMI</span>
                            <h2 class="section__title">Referensi</h2>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="df-portfolio__navigation d-flex gap-3 justify-content-md-end">
                            <div class="portfolio__slider-button-prev slider__nav-btn"><i class="icon-022-left"></i>
                            </div>
                            <div class="portfolio__slider-button-next slider__nav-btn"><i class="icon-021-next"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper portfolio__slider wow fadeInUp" data-wow-delay=".3s">
                <div class="swiper-wrapper" id="list_project">

                </div>
            </div>
            <div class="df-portfolio__area-btn text-center mt-60 wow fadeInUp" data-wow-delay=".3s">
                <a href="#" class="primary-btn hover-white">Selengkapnya
                    <span class="icon__box">
                        <img class="icon__first" src="assets/img/icon/arrow-white.webp" alt="image not found">
                        <img class="icon__second" src="assets/img/icon/arrow-black.webp" alt="image not found">
                    </span>
                </a>
            </div>
        </section>
        <!-- portfolio area end  -->

        <!-- benifits area start  -->
        <section class="df-benifits__area section-spacing-bottom">
            <div class="container">
                <div class="row align-items-center justify-content-between g-50 wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-xl-7">
                        <div class="section__title-wrapper section-title-spacing">
                            {{-- <span class="section__subtitle bg-lighter">KENAPA PILIH PRALON</span> --}}
                            <span class="section__subtitle bg-lighter">KENAPA MEMILIH MEREK PRALON</span>
                            <h2 class="section__title">Sudah Teruji Selama 60 Tahun</h2>
                            <p class="mt-35 mb-35">Ketika kamu membutuhkan perpipaan, inilah 5 alasan kenapa kamu harus
                                memilih merek Pralon.</p>
                        </div>
                        <div class="df-benifits__wrapper">
                            <div class="row justify-content-between" id="pralon_point_plus_list">
                                <div class="col-xl-6 col-md-6">
                                    <div class="df-benifits__single-box">
                                        <div class="df-benifits__icon">
                                            <i class="icon-df-service"></i>
                                        </div>
                                        <div class="df-benifits__content">
                                            <h4 class="df-benifits__title">Quality Assurance</h4>
                                            <p class="df-benifits__sub-title">Menerapkan Standar Mutu ISO 9001, ISO 14001,
                                                OHSAS 45001 dan Green Label Indonesia.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6">
                                    <div class="df-benifits__single-box">
                                        <div class="df-benifits__icon">
                                            <i class="icon-036-star-1"></i>
                                        </div>
                                        <div class="df-benifits__content">
                                            <h4 class="df-benifits__title">Experience</h4>
                                            <p class="df-benifits__sub-title">Pengalaman lebih dari 60 tahun.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6">
                                    <div class="df-benifits__single-box">
                                        <div class="df-benifits__icon">
                                            <i class="icon-031-like"></i>
                                        </div>
                                        <div class="df-benifits__content">
                                            <h4 class="df-benifits__title">Quality Product</h4>
                                            <p class="df-benifits__sub-title">Menggunakan Bahan Baku dan Aditif Khusus ,
                                                Kuat, Tahan Lama, Tahan Terhadap Korosi, dan tidak mudah pecah.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6">
                                    <div class="df-benifits__single-box">
                                        <div class="df-benifits__icon">
                                            <i class="fa-regular fa-recycle"></i>
                                        </div>
                                        <div class="df-benifits__content">
                                            <h4 class="df-benifits__title">Recycle</h4>
                                            <p class="df-benifits__sub-title">Terbuat dari bahan baku yang dapat di daur
                                                ulang.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6">
                                    <div class="df-benifits__single-box">
                                        <div class="df-benifits__icon">
                                            <i class="icon-df-service"></i>
                                        </div>
                                        <div class="df-benifits__content">
                                            <h4 class="df-benifits__title">Passed</h4>
                                            <p class="df-benifits__sub-title">Lulus Uji Muti Laboratorium.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bf-benifits__btn text-xl-start text-md-center mt-50">
                                <a href="{{ route('about-us') }}" class="primary-btn hover-white">Selengkapnya
                                    <span class="icon__box">
                                        <img class="icon__first" src="assets/img/icon/arrow-white.webp"
                                            alt="image not found">
                                        <img class="icon__second" src="assets/img/icon/arrow-black.webp"
                                            alt="image not found">
                                    </span>
                                </a>
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
        <!-- benifits area end  -->

        <!-- testimonial area start  -->
        <section class="df-testimonial__area section-spacing bg-theme-4 p-relative x-clip z-index-3">
            <div class="container">
                <div class="df-testimonial__wrapper p-relative wow fadeInUp" data-wow-delay=".3s">
                    <div class="swiper testimonial__slider">
                        <div class="swiper-wrapper" id="testimonial_list">
                            <div class="swiper-slide">
                                <div class="df-testimonial__box">
                                    <div class="df-testimonial__box-content">
                                        <div class="df-testimonial__icon">
                                            <i class="icon-020-quote"></i>
                                        </div>
                                        <div class="df-testimonial__text">
                                            <p>
                                                Saya memilih pipa uPVC Pralon untuk instalasi saluran air di rumah saya, dan
                                                saya sangat puas dengan kualitasnya. Tidak ada kebocoran dan aliran air
                                                menjadi lancar. Sangat merekomendasikan!.
                                            </p>
                                        </div>
                                        <div class="df-testimonial__author-meta d-flex justify-content-center">
                                            <div class="df-testimonial__author-review">
                                                <h4 class="df-testimonial__author">Rita</h4>
                                                <span style="font-size: 16px !important;">Pemilik Rumah Tangga</span>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="df-testimonial__box">
                                    <div class="df-testimonial__box-content">
                                        <div class="df-testimonial__icon">
                                            <i class="icon-020-quote"></i>
                                        </div>
                                        <div class="df-testimonial__text">
                                            <p>
                                                Sebagai seorang kontraktor, saya selalu memilih pipa Pralon untuk
                                                proyek-proyek saya. Kualitasnya yang terjamin dan daya tahan yang luar biasa
                                                membuatnya menjadi pilihan utama saya. Pelanggan saya juga senang dengan
                                                hasil akhirnya.
                                            </p>
                                        </div>
                                        <div class="df-testimonial__author-meta d-flex justify-content-center">
                                            <div class="df-testimonial__author-review">
                                                <h4 class="df-testimonial__author">Haryo</h4>
                                                <span style="font-size: 16px !important;">Kontraktor Bangunan</span>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="df-testimonial__box">
                                    <div class="df-testimonial__box-content">
                                        <div class="df-testimonial__icon">
                                            <i class="icon-020-quote"></i>
                                        </div>
                                        <div class="df-testimonial__text">
                                            <p>
                                                Pipa uPVC Pralon telah menjadi solusi yang andal untuk kebutuhan air di
                                                restoran saya. Dengan intensitas penggunaan yang tinggi, pipa Pralon tetap
                                                kokoh dan tidak pernah mengecewakan. Terima kasih atas produk yang luar
                                                biasa!
                                            </p>
                                        </div>
                                        <div class="df-testimonial__author-meta d-flex justify-content-center">
                                            <div class="df-testimonial__author-review">
                                                <h4 class="df-testimonial__author">Fitri</h4>
                                                <span style="font-size: 16px !important;">Pemilik Restoran</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="df-testimonial__box">
                                    <div class="df-testimonial__box-content">
                                        <div class="df-testimonial__icon">
                                            <i class="icon-020-quote"></i>
                                        </div>
                                        <div class="df-testimonial__text">
                                            <p>
                                                Sebagai pengembang properti, kualitas dan keandalan sangat penting bagi
                                                kami. Itulah mengapa kami selalu memilih pipa uPVC Pralon untuk
                                                proyek-proyek kami. Produk ini terbukti tahan lama dan memberikan kinerja
                                                yang konsisten.
                                            </p>
                                        </div>
                                        <div class="df-testimonial__author-meta d-flex justify-content-center">
                                            <div class="df-testimonial__author-review">
                                                <h4 class="df-testimonial__author">Budi</h4>
                                                <span style="font-size: 16px !important;">Pengembang Properti</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="df-testimonial__box">
                                    <div class="df-testimonial__box-content">
                                        <div class="df-testimonial__icon">
                                            <i class="icon-020-quote"></i>
                                        </div>
                                        <div class="df-testimonial__text">
                                            <p>
                                                Sebagai pemilik industri makanan dan minuman, kebersihan sistem perpipaan
                                                sangat penting bagi kami. Pipa uPVC Pralon tidak hanya terbukti aman untuk
                                                digunakan dalam lingkungan makanan, tetapi juga mudah dipasang dan tidak
                                                memerlukan perawatan berkelanjutan. Kami sangat senang dengan performanya.
                                            </p>
                                        </div>
                                        <div class="df-testimonial__author-meta d-flex justify-content-center">
                                            <div class="df-testimonial__author-review">
                                                <h4 class="df-testimonial__author">Dewi</h4>
                                                <span style="font-size: 16px !important;">Pemilik Industri Makanan dan
                                                    Minuman</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="df-testimonial__navigation">
                        <div class="testimonial__slider-button-prev slider__nav-btn"><i class="icon-022-left"></i>
                        </div>
                        <div class="testimonial__slider-button-next slider__nav-btn"><i class="icon-021-next"></i>
                        </div>
                    </div>
                    <div class="testimonial__slider-pagination df__pagination mt-60 justify-content-center wow fadeInUp"
                        data-wow-delay=".3s"></div>
                </div>
            </div>
        </section>
        <!-- testimonial area end  -->
        {{-- <img src="{{ asset('storage/uploads/html/404-v1.jpg') }}" alt=""> --}}
        <!-- blog area start  -->
        <section class="df-blog__area section-spacing">
            <div class="container">
                <div class="row justify-content-center section-title-spacing wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-xl-8">
                        <div class="section__title-wrapper text-center">
                            <span class="section__subtitle bg-lighter">BERITA KAMI</span>
                            <h2 class="section__title">Berita & Blog</h2>
                        </div>
                    </div>
                </div>
                <div class="df-blog5__wrapper">
                    <div class="swiper blog__slider">
                        <div class="swiper-wrapper" id="list_berita">
                        </div>
                    </div>
                </div>
                <div class="blog__slider-pagination df__pagination mt-70 p-relative z-index-5 justify-content-center wow fadeInUp"
                    data-wow-delay=".3s"></div>
            </div>
        </section>
        <!-- blog area end  -->

    </main>
    @include('layouts.users.footer')
@endsection
@push('css')
    <style>
        .service__text {
            display: -webkit-box;
            /* Gunakan Flexbox khusus untuk teks */
            -webkit-line-clamp: 2;
            /* Tentukan jumlah maksimum baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
            /* Potong konten yang melampaui batas */
            text-overflow: ellipsis;
            /* Tambahkan "..." jika teks dipotong */
        }
    </style>
@endpush
@push('js')
    @include('users.home.home_js')
@endpush
