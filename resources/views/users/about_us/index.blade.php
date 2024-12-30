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
                            <img src="{{ asset('assets/img/pralon/youtube_thumbnail.jpg') }}" alt="image not found">
                            <div class="df-video__play-btn pos-center">
                                <a href="https://www.youtube.com/watch?v=bOXO3_AvfFY" class="play-btn popup-video"><i
                                        class="icon-008-play-button"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class=" col-xxl-6 col-xl-6 col-lg-5 order-lg-1 order-0">
                        <div class="df-about3__content">
                            <div class="section__title-wrapper">
                                <span class="section__subtitle bg-lighter">TENTANG KAMI</span>
                                <h2 class="section__title">Sejarah Pralon</h2>
                            </div>
                            <p class="mt-35 mb-35">
                                Pralon adalah merek dagang dari pipa uPVC berkualitas tinggi yang di produksi oleh PT
                                Pralon. Pralon telah lama dikenal sejak tahun 1963 sebagai pelopor dalam industri pipa uPVC
                                di Indonesia. Dengan menggunakan teknologi mutakhir dan standard produksi yang tinggi, PT
                                Pralon telah berhasil mencipt akan produk-produk dengan kualitas terbaik.
                            </p>
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

        <!-- questions area start  -->
        <section class="df-benifits__area section-spacing bg-theme-4">
            <div class="container">
                <div class="row align-items-center justify-content-between g-50 wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-xl-7">
                        <div class="section__title-wrapper section-title-spacing">
                            <span class="section__subtitle bg-lighter">KENAPA MEMILIH MEREK PRALON</span>
                            <h2 class="section__title">Sudah Teruji Selama 60 Tahun</h2>
                            <p class="mt-35 mb-35">Ketika kamu membutuhkan perpipaan, inilah 5 alasan kenapa kamu harus
                                memilih merek Pralon.</p>
                        </div>
                        <div class="df-benifits__wrapper">
                            <div class="row justify-content-between" id="pralon_point_plus_list">
                            </div>
                            <div class="bf-benifits__btn text-xl-start text-md-center mt-50">
                                <a href="#" class="primary-btn hover-white">Selengkapnya
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
        <!-- questions area end  -->

        <!-- system area start -->
        <section class="df-system__area">
            <div class="container">
                <div class="df-system__wrapper section-spacing">
                    <div class="df-system__thumb" data-background="assets/img/system/img-1.webp">
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
                                        <p>PRALON menjadi perusahaan terkemuka dalam penyediaan bahan – bahan bangunan
                                            berkualitas melalui inovasi yang terus menerus dan SDM yang kompeten serta
                                            teknologi terkini untuk memberikan pertumbuhan berkesinambungan bagi
                                            stakeholder.
                                        </p>
                                    </div>
                                    <div class="df-system__content">
                                        <div class="section__title-wrapper mb-30">
                                            <span class="section__subtitle bg-lighter">MISI</span>
                                            <h2 class="section__title">Misi Pralon</h2>
                                        </div>
                                        <ol style="font-size: 16px; !important">
                                            <li>
                                                <p>Memproduksi produk berkualitas yang mudah didapat dan peduli terhadap lingkungan dengan harga yang sesuai (Value for money) sehingga memberikan kepuasan pelanggan.</p>
                                            </li>
                                            <li>
                                                <p>
                                                    Senantiasa ber-inovasi dalam proses dan teknologi agar dapat memenuhi kebutuhan pasar (market oriented).
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    Menjadi tempat yang membanggakan bagi karyawan yang kompeten untuk berkarya dan mengembangkan diri secara optimal.
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    Memberikan pertumbuhan berkesinambungan kepada stakeholder.
                                                </p>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="df-timeline__slider">
                            <div class="timeline__slider-nav timeline-slider-arrow"></div>
                            <div class="loading-bar line-bar" id="indicator_visi_misi">
                                {{-- <div class="loading-bar-bullet"></div>
                                <div class="loading-bar-bullet"></div> --}}
                                {{-- {{-- <div class="loading-bar-bullet"></div> --}}
                                {{-- <div class="loading-bar-bullet"></div>
                                <div class="loading-bar-bullet"></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- system area end -->
        <!-- pralon value -->
        <section class="df-requirement__area section-spacing">
            <div class="container">
                <div class="row gy-5 wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-lg-5 col-md-6">
                        <div class="section__title-wrapper">
                            <h2 class="section__title">Pralon Values</h2>
                        </div>
                        <div class="df-requirement__button-wrapper">
                            <a href="contact.html" class="primary-btn">Contact Us
                                <span class="icon__box">
                                    <img class="icon__first" src="assets/img/icon/arrow-white.webp"
                                        alt="image not found">
                                    <img class="icon__second" src="assets/img/icon/arrow-white.webp"
                                        alt="image not found">
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="df-requirement__feature-list">
                            <ul>
                                <li>
                                    <span class="list-icon">
                                        <i class="icon-058-check"></i>
                                    </span>
                                    <p>All types of faucet installation</p>
                                </li>
                                <li>
                                    <span class="list-icon">
                                        <i class="icon-058-check"></i>
                                    </span>
                                    <p>All types of faucet repair & maintenance</p>
                                </li>
                                <li>
                                    <span class="list-icon">
                                        <i class="icon-058-check"></i>
                                    </span>
                                    <p>Fast & reliable services</p>
                                </li>
                                <li>
                                    <span class="list-icon">
                                        <i class="icon-058-check"></i>
                                    </span>
                                    <p>Skilled & Trained personel</p>
                                </li>
                                <li>
                                    <span class="list-icon">
                                        <i class="icon-058-check"></i>
                                    </span>
                                    <p>Emergency services</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- pralon value end -->
        <!-- portfolio style 01 start -->
        <section class="df-portfolio__area section-spacing">
            <div class="container">
                <div class="row align-items-end section-title-spacing g-5 wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-lg-8 col-md-8">
                        <div class="section__title-wrapper">
                            <span class="section__subtitle bg-lighter">Sertifikasi </span>
                            <h2 class="section__title">Daftar List Sertifikat</h2>
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
                <div class="swiper-wrapper" id="list_sertifikat">
                    <div class="swiper-slide">
                        <div class="df-portfolio__item-box">
                            <div class="df-portfolio__item-thumb">
                                <a href="portfolio-details.html"><img src="assets/img/plumbing/img-05.webp"
                                        alt="image not found"></a>
                            </div>
                            <div class="df-portfolio__item-content">
                                <div class="df-portfolio__item-info">
                                    <h4 class="df-portfolio__item-title"><a href="portfolio-details.html">Filter
                                            Plumbing Fix</a></h4>
                                    <span class="tag">Pipe Fixing</span>
                                </div>
                                <div class="df-portfolio__item-btn">
                                    <a href="portfolio-details.html" class="circle-btn is-white">
                                        <span class="icon__box">
                                            <img class="icon__first" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                            <img class="icon__second" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="df-portfolio__item-box">
                            <div class="df-portfolio__item-thumb">
                                <a href="portfolio-details.html"><img src="assets/img/plumbing/img-06.webp"
                                        alt="image not found"></a>
                            </div>
                            <div class="df-portfolio__item-content">
                                <div class="df-portfolio__item-info">
                                    <h4 class="df-portfolio__item-title"><a href="portfolio-details.html">Bathroom
                                            Plumbing Fix</a></h4>
                                    <span class="tag">Pipe Fixing</span>
                                </div>
                                <div class="df-portfolio__item-btn">
                                    <a href="portfolio-details.html" class="circle-btn is-white">
                                        <span class="icon__box">
                                            <img class="icon__first" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                            <img class="icon__second" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="df-portfolio__item-box">
                            <div class="df-portfolio__item-thumb">
                                <a href="portfolio-details.html"><img src="assets/img/plumbing/img-07.webp"
                                        alt="image not found"></a>
                            </div>
                            <div class="df-portfolio__item-content">
                                <div class="df-portfolio__item-info">
                                    <h4 class="df-portfolio__item-title"><a href="portfolio-details.html">Pipe
                                            Plumbing Fix</a></h4>
                                    <span class="tag">Pipe Fixing</span>
                                </div>
                                <div class="df-portfolio__item-btn">
                                    <a href="portfolio-details.html" class="circle-btn is-white">
                                        <span class="icon__box">
                                            <img class="icon__first" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                            <img class="icon__second" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="df-portfolio__item-box">
                            <div class="df-portfolio__item-thumb">
                                <a href="portfolio-details.html"><img src="assets/img/plumbing/img-08.webp"
                                        alt="image not found"></a>
                            </div>
                            <div class="df-portfolio__item-content">
                                <div class="df-portfolio__item-info">
                                    <h4 class="df-portfolio__item-title"><a href="portfolio-details.html">Basin
                                            Plumbing Fix</a></h4>
                                    <span class="tag">Pipe Fixing</span>
                                </div>
                                <div class="df-portfolio__item-btn">
                                    <a href="portfolio-details.html" class="circle-btn is-white">
                                        <span class="icon__box">
                                            <img class="icon__first" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                            <img class="icon__second" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="df-portfolio__item-box">
                            <div class="df-portfolio__item-thumb">
                                <a href="portfolio-details.html"><img src="assets/img/plumbing/img-06.webp"
                                        alt="image not found"></a>
                            </div>
                            <div class="df-portfolio__item-content">
                                <div class="df-portfolio__item-info">
                                    <h4 class="df-portfolio__item-title"><a href="portfolio-details.html">Bathroom
                                            Plumbing Fix</a></h4>
                                    <span class="tag">Pipe Fixing</span>
                                </div>
                                <div class="df-portfolio__item-btn">
                                    <a href="portfolio-details.html" class="circle-btn is-white">
                                        <span class="icon__box">
                                            <img class="icon__first" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                            <img class="icon__second" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="df-portfolio__item-box">
                            <div class="df-portfolio__item-thumb">
                                <a href="portfolio-details.html"><img src="assets/img/plumbing/img-05.webp"
                                        alt="image not found"></a>
                            </div>
                            <div class="df-portfolio__item-content">
                                <div class="df-portfolio__item-info">
                                    <h4 class="df-portfolio__item-title"><a href="portfolio-details.html">Filter
                                            Plumbing Fix</a></h4>
                                    <span class="tag">Pipe Fixing</span>
                                </div>
                                <div class="df-portfolio__item-btn">
                                    <a href="portfolio-details.html" class="circle-btn is-white">
                                        <span class="icon__box">
                                            <img class="icon__first" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                            <img class="icon__second" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="df-portfolio__item-box">
                            <div class="df-portfolio__item-thumb">
                                <a href="portfolio-details.html"><img src="assets/img/plumbing/img-06.webp"
                                        alt="image not found"></a>
                            </div>
                            <div class="df-portfolio__item-content">
                                <div class="df-portfolio__item-info">
                                    <h4 class="df-portfolio__item-title"><a href="portfolio-details.html">Bathroom
                                            Plumbing Fix</a></h4>
                                    <span class="tag">Pipe Fixing</span>
                                </div>
                                <div class="df-portfolio__item-btn">
                                    <a href="portfolio-details.html" class="circle-btn is-white">
                                        <span class="icon__box">
                                            <img class="icon__first" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                            <img class="icon__second" src="assets/img/icon/arrow-theme.webp"
                                                alt="image not found">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="df-portfolio__area-btn text-center mt-60 wow fadeInUp" data-wow-delay=".3s">
                <a href="portfolio-classic.html" class="primary-btn">More work
                    <span class="icon__box">
                        <img class="icon__first" src="assets/img/icon/arrow-white.webp" alt="image not found">
                        <img class="icon__second" src="assets/img/icon/arrow-white.webp" alt="image not found">
                    </span>
                </a>
            </div> --}}
        </section>
        <!-- portfolio style 01 end -->
        
    </main>
    <!-- footer-area-start -->
    @include('layouts.users.footer')
@endsection
@push('js')
    <script>
        fetchWhyPralon()

        function fetchWhyPralon() {
            $('#pralon_point_plus_list').empty()
            let dummy_pralon = [{
                    'title': 'Quality Assurance',
                    'desc': 'Menerapkan Standar Mutu ISO 9001, ISO 14001, OHSAS 45001 dan Green Label Indonesia.',
                    'icon': '<i class="icon-df-service" style=""></i>'
                },
                {
                    'title': 'Experience',
                    'desc': 'Pengalaman lebih dari 60 tahun.',
                    'icon': '<i class="icon-036-star-1" style=""></i>'
                },
                {
                    'title': 'Quality Product',
                    'desc': 'Menggunakan Bahan Baku dan Aditif Khusus , Kuat, Tahan Lama, Tahan Terhadap Korosi, dan tidak mudah pecah.',
                    'icon': '<i class="icon-053-price" style=""></i>'
                },
                {
                    'title': 'Recycle',
                    'desc': 'Terbuat dari bahan baku yang dapat di daur ulang.',
                    'icon': '<i class="icon-031-like" style=""></i>'
                },
                {
                    'title': 'Passed',
                    'desc': 'Lulus Uji Muti Laboratorium.',
                    'icon': '<i class="icon-031-like" style=""></i>'
                },
            ];
            $.each(dummy_pralon, function(i, data) {
                $('#pralon_point_plus_list').append(`
                    <div class="col-xl-6 col-md-6">
                        <div class="df-benifits__single-box">
                            <div class="df-benifits__icon">
                                ${data.icon}
                            </div>
                            <div class="df-benifits__content">
                                <h4 class="df-benifits__title">${data.title}</h4>
                                <p class="df-benifits__sub-title">${data.desc}</p>
                            </div>
                        </div>
                    </div>
                `)
            })
        }

        fetchVisiMisi()

        function fetchVisiMisi() {
            // $('#list_visi_misi').empty()
            // $('#indicator_visi_misi').empty()

            let dummy_visi_misi = [{
                    'name': 'VISI',
                    'data': 'PRALON menjadi perusahaan terkemuka dalam penyediaan bahan - bahan bangunan berkualitas melalui inovasi yang terus menerus dan SDM yang kompeten serta teknologi terkini untuk memberikan pertumbuhan berkesinambungan bagi stakeholder.',
                },
                {
                    'name': 'MISI',
                    'data': [
                        'Memproduksi produk berkualitas yang mudah didapat dan peduli terhadap lingkungan dengan harga yang sesuai (Value for money) sehingga memberikan kepuasan pelanggan.',
                        'Senantiasa ber-inovasi dalam proses dan teknologi agar dapat memenuhi kebutuhan pasar (market oriented).',
                        'Menjadi tempat yang membanggakan bagi karyawan yang kompeten untuk berkarya dan mengembangkan diri secara optimal.',
                        'Memberikan pertumbuhan berkesinambungan kepada stakeholder.',

                    ]
                }
            ];

            $.each(dummy_visi_misi, function(i, data) {
                // $('#list_visi_misi').append(`
            //     <div class="df-system__content">
            //         <div class="section__title-wrapper mb-30">
            //             <span class="section__subtitle bg-lighter">${data.name}</span>
            //             <h2 class="section__title">First Urban Sanitation Systems</h2>
            //         </div>
            //         <p>The first urban sanitation systems emerged in various ancient civilizations
            //             as a response to the need for managing waste and promoting public health.
            //         </p>
            //     </div>
            // `)
                // $('#indicator_visi_misi').append(`
            //     <div class="loading-bar-bullet"></div>
            // `)
            });

            // alert(dummy_visi_misi.length)

            // for (let index = 0; index < dummy_visi_misi.length; index++) {
            //     $('#list_visi_misi').append(`
        //         <div class="df-system__content">
        //             <div class="section__title-wrapper mb-30">
        //                 <span class="section__subtitle bg-lighter">${data.name}</span>
        //                 <h2 class="section__title">First Urban Sanitation Systems</h2>
        //             </div>
        //             <p>The first urban sanitation systems emerged in various ancient civilizations
        //                 as a response to the need for managing waste and promoting public health.
        //             </p>
        //         </div>
        //     `)
            //     $('#indicator_visi_misi').append(`
        //         <div class="loading-bar-bullet"></div>
        //     `)
            // }
        }
        fetchSertifikat()
        function fetchSertifikat() {
            let data_sertifikat = [
                {
                    'name': 'ISO 9001',
                    'desc': 'Quality Management System',
                    'img': '{{ asset("assets/img/pralon/sertifikat/9001.jpg") }}'
                },
                {
                    'name': 'ISO 14001',
                    'desc': 'Environmental Management System',
                    'img': '{{ asset("assets/img/pralon/sertifikat/14001.jpg") }}'
                },
                {
                    'name': 'ISO 45001',
                    'desc': 'Occupational Health and Safety Management System',
                    'img': '{{ asset("assets/img/pralon/sertifikat/45001.jpg") }}'
                },
                {
                    'name': 'Green Label Indonesia',
                    'desc': 'Quality Management System',
                    'img': '{{ asset("assets/img/pralon/sertifikat/green_label_indonesia.jpg") }}'
                },
            ];

            $('#list_sertifikat').empty()
            $.each(data_sertifikat, function(i, sertifikat) {
                $('#list_sertifikat').append(`
                    <div class="swiper-slide">
                        <div class="df-portfolio__item-box">
                            <div class="df-portfolio__item-thumb">
                                <a href="portfolio-details.html"><img src="${sertifikat.img}"
                                        alt="image not found"></a>
                            </div>
                            <div class="df-portfolio__item-content">
                                <div class="df-portfolio__item-info">
                                    <h4 class="df-portfolio__item-title"><a href="#">${sertifikat.name}</a></h4>
                                    <span class="tag">${sertifikat.desc}</span>
                                </div>
                                <div class="df-portfolio__item-btn">
                                    <a href="#" class="circle-btn is-red">
                                        <span class="icon__box">
                                            <img class="icon__first" src="assets/img/icon/arrow-white.webp" alt="image not found">
                                            <img class="icon__second" src="assets/img/icon/arrow-white.webp" alt="image not found">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `)
            })
        }
    </script>
@endpush
