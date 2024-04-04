@extends('layouts.users.app')

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
                        <h1 class="hero__title wow fadeInUp" data-wow-delay=".5s">Kualitas Teruji <br> Sistem <br> Perpipaan</h1>
                    </div>
                    <p class="hero__text wow fadeInUp" data-wow-delay=".7s">60 tahun pipa merek Pralon berkontribusi untuk mengalirkan air bersih dan air buangan di seluruh pelosok Indonesia. Kualitas dari produk pipa maupun aksesoris merek Pralon sudah teruji dan terbukti yang akan terus bertahan mengikuti perkembangan dan pertumbuhan pipanisasi di Indonesia, juga bertanggung jawab terhadap lingkungan dengan standarisasi Green Product Indonesia.</p>
                    <div class="hero__button wow fadeInUp" data-wow-delay=".9s">
                        <a href="#" class="primary-btn hover-white">Selengkapnya
                            <span class="icon__box">
                                <img class="icon__first" src="assets/img/icon/arrow-white.webp" alt="image not found">
                                <img class="icon__second" src="assets/img/icon/arrow-black.webp" alt="image not found">
                            </span>
                        </a>
                        {{-- <div class="feedback__wrapper">
                            <div class="rating__icon mb-15">
                                <i class="icon-004-star"></i>
                                <i class="icon-004-star"></i>
                                <i class="icon-004-star"></i>
                                <i class="icon-004-star"></i>
                                <i class="icon-004-star"></i>
                            </div>
                            <p class="xsmall fw-500 lh-1">2,984 Feedback</p>
                        </div> --}}
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
                                    {{-- <video src="assets/video/hero.mp4" loop muted autoplay playsinline></video> --}}
                                    <video src="{{ asset('assets/video/hero_video.MOV') }}" loop muted autoplay playsinline></video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__img">
                <span class="hero__img-overlay"></span>
                <img src="{{ asset('assets/img/pralon/header_image.jpg') }}" alt="image not found">
            </div>
        </section>
        <!-- hero area end  -->

        <!-- services area start  -->
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
        <!-- services area end  -->

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
                            <p class="mt-35 mb-35">Pralon adalah merek dagang dari pipa uPVC berkualitas tinggi yang di produksi oleh PT Pralon. Pralon telah lama dikenal sejak tahun 1963 sebagai pelopor dalam industri pipa uPVC di Indonesia. Dengan menggunakan teknologi mutakhir dan standard produksi yang tinggi, PT Pralon telah berhasil menciptakan produk-produk dengan kualitas terbaik.</p>
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
                                <a href="about.html" class="primary-btn hover-white">Selengkapnya
                                    <span class="icon__box">
                                        <img class="icon__first" src="assets/img/icon/arrow-white.webp" alt="image not found">
                                        <img class="icon__second" src="assets/img/icon/arrow-black.webp" alt="image not found">
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
                <a href="portfolio-classic.html" class="primary-btn hover-white">Selengkapnya
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
                            <p class="mt-35 mb-35">Ketika kamu membutuhkan perpipaan, inilah 5 alasan kenapa kamu harus memilih merek Pralon.</p>
                        </div>
                        <div class="df-benifits__wrapper">
                            <div class="row justify-content-between" id="pralon_point_plus_list">
                                
                            </div>
                            <div class="bf-benifits__btn text-xl-start text-md-center mt-50">
                                <a href="about-v2.html" class="primary-btn hover-white">Selengkapnya
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
                                            <p>Very nice man. Work was carried out to a very high standard. Cleaned up
                                                after as well leaving no mess behind. I will be using his services
                                                again. Thanks for your best plumbing service. We recommended to other.
                                            </p>
                                        </div>
                                        <div class="df-testimonial__author-meta d-flex justify-content-center">
                                            <div class="df-testimonial__author-thumb">
                                                <img src="assets/img/clients/client-01.webp" alt="image not found">
                                            </div>
                                            <div class="df-testimonial__author-review">
                                                <h4 class="df-testimonial__author">Florina Jacky</h4>
                                                <div class="df-satisfaction__ratings">
                                                    <ul>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                    </ul>
                                                </div>
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
                                            <p>Excellent service! The plumber arrived on time and quickly fixed the leak
                                                under
                                                our sink.Very professional.I highly recommend this plumber. They were
                                                courteous,
                                                knowledgeable, and their rates were reasonable.
                                            </p>
                                        </div>
                                        <div class="df-testimonial__author-meta d-flex justify-content-center">
                                            <div class="df-testimonial__author-thumb">
                                                <img src="assets/img/clients/client-02.webp" alt="image not found">
                                            </div>
                                            <div class="df-testimonial__author-review">
                                                <h4 class="df-testimonial__author">Florina Jacky</h4>
                                                <div class="df-satisfaction__ratings">
                                                    <ul>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                    </ul>
                                                </div>
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
                                            <p>Absolutely fantastic service! The plumber was prompt, professional, and
                                                fixed our
                                                issue quickly.I'm so glad I called this plumber. They were friendly,
                                                explained
                                                the problem clearly, and provided a reasonable quote.
                                            </p>
                                        </div>
                                        <div class="df-testimonial__author-meta d-flex justify-content-center">
                                            <div class="df-testimonial__author-thumb">
                                                <img src="assets/img/clients/client-03.webp" alt="image not found">
                                            </div>
                                            <div class="df-testimonial__author-review">
                                                <h4 class="df-testimonial__author">Florina Jacky</h4>
                                                <div class="df-satisfaction__ratings">
                                                    <ul>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                    </ul>
                                                </div>
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
                                            <p>The plumber resolved the issue, but there was a slight delay in their
                                                arrival.
                                                Average service. The plumber did the job, but there wasn't anything
                                                exceptional
                                                about the experience.
                                            </p>
                                        </div>
                                        <div class="df-testimonial__author-meta d-flex justify-content-center">
                                            <div class="df-testimonial__author-thumb">
                                                <img src="assets/img/clients/client-04.webp" alt="image not found">
                                            </div>
                                            <div class="df-testimonial__author-review">
                                                <h4 class="df-testimonial__author">Florina Jacky</h4>
                                                <div class="df-satisfaction__ratings">
                                                    <ul>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                        <li><i class="icon-004-star"></i></li>
                                                    </ul>
                                                </div>
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

        <!-- brands area start  -->
        <div class="brand__area section-spacing-bottom">
            <div class="container">
                <div class="brands__wrapper wow fadeInUp" data-wow-delay=".3s">
                    <div class="swiper brand__slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="brand__item">
                                    <img src="assets/img/brands/brand-01.svg" alt="image not found">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand__item">
                                    <img src="assets/img/brands/brand-02.svg" alt="image not found">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand__item">
                                    <img src="assets/img/brands/brand-03.svg" alt="image not found">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand__item">
                                    <img src="assets/img/brands/brand-04.svg" alt="image not found">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand__item">
                                    <img src="assets/img/brands/brand-05.svg" alt="image not found">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand__item">
                                    <img src="assets/img/brands/brand-02.svg" alt="image not found">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand__item">
                                    <img src="assets/img/brands/brand-01.svg" alt="image not found">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- brands area end  -->
    </main>
    @include('layouts.users.footer')
@endsection
@push('js')
    <script>
        $(document).ready(function() {

            fetchProduct()
            
            function fetchProduct() {
                let dummy_product = [
                    {
                        'name': 'Pipa uPVC SNI',
                        'desc': 'Dibuat dari bahan baku Polyvinyl Chloride (PVC) dengan standar SNI.',
                    },
                    {
                        'name': 'Pipa Gold JIS',
                        'desc': 'Untuk aplikasi air bersih dan air buangan digunakan di rumah tinggal, apartemen dan prasarana lainnya.',
                    },
                    {
                        'name': 'Pralon Standard',
                        'desc': 'Pipa dengan kualitas terbaik, karakteristik kuat, ringan, bebas timbal dan mudah dalam pemasangan.',
                    },
                    {
                        'name': 'Pralon Jacking',
                        'desc': 'Untuk air bungan limbah, dengan metode jacking tanpa ada galian di permukaan tanah.',
                    },
                    {
                        'name': 'Pralon HDPE',
                        'desc': 'Memiliki sifat yang lentur, tidak  mudah retak, ringan dan umur pakai yang sangat panjang.',
                    },
                    {
                        'name': 'Pralon MDPE',
                        'desc': 'Digunakan untuk pipanisasi gas untuk industri, perumahan, dan prasana umum.',
                    },
                    {
                        'name': 'Pralon Subduct',
                        'desc': 'Digunakan sebagai pelindung kabel fiber-optic (FO) pada jaringan telekomunikasi.',
                    },
                    {
                        'name': 'Pralon HIC',
                        'desc': 'Sebagai pelindung kabel Listrik dan kabel elektronik, sehingga aman dan rapi terpasang.',
                    },
                    {
                        'name': 'Injection Fittings',
                        'desc': 'Diproduksi dengan system injection moulding memberikan jaminan kekuatan dan keakuratan.',
                    },
                    {
                        'name': 'Handmade Fitting',
                        'desc': 'Dirancang untuk dapat memenuhi segala kebutuhan instalasi pipa dengan efesiensi dan akurasi yang tertinggi.',
                    },
                    {
                        'name': 'Solvent Cement',
                        'desc': 'Sebagai perekat senyawa yang menyatukan baik pipa maupun dengan sambungannya.',
                    },
                    {
                        'name': 'Lubricant',
                        'desc': 'Pelumas ramah lingkungan digunakan pada sambungan rubber-ring joint system.',
                    },
                ];
                $('#list_product').empty()
                $.each(dummy_product, function(i, data) {
                    $('#list_product').append(`
                        <div class="swiper-slide">
                            <div class="service__box wow fadeInUp" data-wow-delay=".9s">
                                <div class="service__content">
                                    <div class="service__img">
                                        <img src="assets/img/service/kitchen.webp" alt="image not found">
                                    </div>
                                    <h4 class="service__title"><a href="service-details.html">${data.name}</a></h4>
                                    <p class="service__text">${data.desc}</p>
                                </div>
                            </div>
                        </div>
                    `)
                })
            }

            fetchProject()
            
            function fetchProject() {
                let dummy_project = [
                    {
                        'name': 'Pembangunan Tambak Udang',
                        'location': 'Bangka, Sumatera Selatan',
                        'img': '{{ asset("assets/img/pralon/projek/1.jpg") }}'
                    },
                    {
                        'name': 'Instalasi Jaringan Air Bersih',
                        'location': 'Bogor, Jawa Barat',
                        'img': '{{ asset("assets/img/pralon/projek/2.jpg") }}'
                    },
                    {
                        'name': 'Sistem Perpipaan Air Limbah',
                        'location': 'Makassar, Sulawesi Selatan',
                        'img': '{{ asset("assets/img/pralon/projek/3.jpg") }}'
                    },
                    {
                        'name': 'Instalasi Jaringan Air Bersih',
                        'location': 'Cirebon, Jawa Barat',
                        'img': '{{ asset("assets/img/pralon/projek/4.jpg") }}'
                    },
                    {
                        'name': 'Instalasi Jaringan Air Bersih',
                        'location': 'Indramayu, Jawa Barat',
                        'img': '{{ asset("assets/img/pralon/projek/5.jpg") }}'
                    },
                ];

                $('#list_project').empty()
                $.each(dummy_project, function(i, data) {
                    $('#list_project').append(`
                        <div class="swiper-slide">
                            <div class="df-portfolio__item-box">
                                <div class="df-portfolio__item-thumb">
                                    <a href="#"><img src="${data.img}"alt="image not found"></a>
                                </div>
                                <div class="df-portfolio__item-content">
                                    <div class="df-portfolio__item-info">
                                        <h4 class="df-portfolio__item-title"><a href="#" id="project_detail">${data.name}</a></h4>
                                        <span class="tag">${data.location}</span>
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

            fetchWhyPralon()
            
            function fetchWhyPralon() {
                $('#pralon_point_plus_list').empty()
                let dummy_pralon = [
                    {
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

            fetchTestimonial()
            
            function fetchTestimonial() {
                $('#testimonial_list').empty()

                let dummy_testi = [
                    {
                        'user': 'Rita',
                        'job': 'Ibu Rumah Tangga',
                        'comment': 'Saya memilih pipa uPVC Pralon untuk instalasi saluran air di rumah saya, dan saya sangat puas dengan kualitasnya. Tidak ada kebocoran dan aliran air menjadi lancar. Sangat merekomendasikan!'
                    },
                    {
                        'user': 'Haryo',
                        'job': 'Kontraktor Bangunan',
                        'comment': 'Sebagai seorang kontraktor, saya selalu memilih pipa Pralon untuk proyek-proyek saya. Kualitasnya yang terjamin dan daya tahan yang luar biasa membuatnya menjadi pilihan utama saya. Pelanggan saya juga senang dengan hasil akhirnya.'
                    },
                    {
                        'user': 'Fitri',
                        'job': 'Pemilik Restoran',
                        'comment': 'Pipa uPVC Pralon telah menjadi solusi yang andal untuk kebutuhan air di restoran saya. Dengan intensitas penggunaan yang tinggi, pipa Pralon tetap kokoh dan tidak pernah mengecewakan. Terima kasih atas produk yang luar biasa!'
                    },
                    {
                        'user': 'Budi',
                        'job': 'Pengembang Properti',
                        'comment': 'Sebagai pengembang properti, kualitas dan keandalan sangat penting bagi kami. Itulah mengapa kami selalu memilih pipa uPVC Pralon untuk proyek-proyek kami. Produk ini terbukti tahan lama dan memberikan kinerja yang konsisten.'
                    },
                    {
                        'user': 'Dewi',
                        'job': 'Pemilik Industri Makanan dan Minuman',
                        'comment': 'Sebagai pemilik industri makanan dan minuman, kebersihan sistem perpipaan sangat penting bagi kami. Pipa uPVC Pralon tidak hanya terbukti aman untuk digunakan dalam lingkungan makanan, tetapi juga mudah dipasang dan tidak memerlukan perawatan berkelanjutan. Kami sangat senang dengan performanya.'
                    },
                ];

                $.each(dummy_testi, function(i, data) {
                    $('#testimonial_list').append(`
                        <div class="swiper-slide">
                            <div class="df-testimonial__box">
                                <div class="df-testimonial__box-content">
                                    <div class="df-testimonial__icon">
                                        <i class="icon-020-quote"></i>
                                    </div>
                                    <div class="df-testimonial__text">
                                        <p>${data.comment}</p>
                                    </div>
                                    <div class="df-testimonial__author-meta d-flex justify-content-center">
                                        <div class="df-testimonial__author-thumb">
                                            <img src="assets/img/clients/client-01.webp" alt="image not found">
                                        </div>
                                        <div class="df-testimonial__author-review">
                                            <h4 class="df-testimonial__author">${data.user+', '+data.job}</h4>
                                            <div class="df-satisfaction__ratings">
                                                <ul>
                                                    <li><i class="icon-004-star"></i></li>
                                                    <li><i class="icon-004-star"></i></li>
                                                    <li><i class="icon-004-star"></i></li>
                                                    <li><i class="icon-004-star"></i></li>
                                                    <li><i class="icon-004-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    `)
                })
            }

            fetchBerita()
            function fetchBerita() {
                $('#list_berita').empty()

                let dummy_berita = [
                    {
                        'tag': 'Tips',
                        'date': '21 Maret 2024',
                        'title': 'Kenapa Air Bersih & Sanitasi Layak Itu Sangat Penting?',
                        'img': '{{ asset("assets/img/pralon/berita/new1.jpg") }}'
                    },
                    {
                        'tag': 'Tips',
                        'date': '22 Maret 2024',
                        'title': 'Cara Pasang Pipa Yang Baik dan Benar',
                        'img': '{{ asset("assets/img/pralon/berita/new2.jpg") }}'
                    },
                    {
                        'tag': 'Tips',
                        'date': '21 Maret 2024',
                        'title': 'Kenapa Air Bersih & Sanitasi Layak Itu Sangat Penting?',
                        'img': '{{ asset("assets/img/pralon/berita/new1.jpg") }}'
                    },
                    {
                        'tag': 'Tips',
                        'date': '22 Maret 2024',
                        'title': 'Cara Pasang Pipa Yang Baik dan Benar',
                        'img': '{{ asset("assets/img/pralon/berita/new2.jpg") }}'
                    },
                ];
                
                $.each(dummy_berita, function(i, data) {
                    $('#list_berita').append(`
                        <div class="swiper-slide">
                            <div class="df-blog5__box wow fadeInUp" data-wow-delay=".5s">
                                <div class="df-blog5__thumb">
                                    <a href="#"><img src="${data.img}" alt="image not found"></a>
                                </div>
                                <div class="df-blog5__content">
                                    <div class="df-blog5__meta">
                                        <span class="blog-category"><a href="">${data.tag}</a></span>
                                        <span class="separate"></span>
                                        <span class="blog-date">${data.date}</span>
                                    </div>
                                    <h3 class="df-blog5__title"><a href="#" id="project_detail">${data.title}</a></h3>
                                    <div class="meta-item">
                                        <a href="#" target="_blank" class="primary-btn hover-white">Read more
                                            <span class="icon__box">
                                                <img class="icon__first" src="assets/img/icon/arrow-white.webp" alt="image not found">
                                                <img class="icon__second" src="assets/img/icon/arrow-black.webp" alt="image not found">
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `)
                })
            }
        })

    </script>
@endpush
