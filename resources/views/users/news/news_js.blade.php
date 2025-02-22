<script>
    $(document).ready(function() {
        var offset_data = 0;
        var limit_fetch = 5;
        // Fungsi untuk mendapatkan parameter dari URL
        function getParameterByName(name, url = window.location.href) {
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }
        // var urlParams = new URLSearchParams(window.location.search);
        // Ambil data terenkripsi dari parameter URL
        var encryptedData = getParameterByName('q');
        var secretKeyFromUrl = getParameterByName('key');

        if (encryptedData && secretKeyFromUrl) {
            try {
                // Konversi secretKey ke format yang bisa digunakan oleh CryptoJS
                var secretKey = CryptoJS.enc.Base64.parse(secretKeyFromUrl);

                // Dekripsi data
                var decrypted = CryptoJS.AES.decrypt(encryptedData, secretKey, {
                    mode: CryptoJS.mode.ECB,
                    padding: CryptoJS.pad.Pkcs7
                });

                var jsonString = decrypted.toString(CryptoJS.enc.Utf8);

                if (jsonString) {
                    var data = JSON.parse(jsonString);
                    console.log("Decrypted Data:", data);

                    // Panggil fetchNews dengan id berita yang telah didekripsi
                    fetchNews(data.id);
                }
            } catch (error) {
                console.error("Error saat dekripsi:", error);
            }
        }

        fetchNewsCategories()
        fetchRecentNews()

        function fetchNews(id = null) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-news') }}',
                type: 'GET',
                data: id ? {
                    id: id
                } : {
                    offset: offset_data,
                    limit: limit_fetch
                },
                dataType: 'json',
                async: true,
                beforeSend: function() {
                    $('#loading_animation_product').show();
                    $('#load_more_news').hide();
                },
                success: function(res) {
                    $('#loading_animation_product').hide();

                    if (id) {
                        // Tampilkan detail berita
                        $('#header_news').hide();
                        $('#list_news_blog').empty();
                        $('#header_detail_news').empty().append(`
                    <section class="page-title-area-2 breadcrumb-spacing bg-theme-4 section-spacing">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xxl-9">
                                <div class="page-title-wrapper-2 text-center">
                                    <h1 class="page__title-2 mb-25">${res.data.title}</h1>
                                    <div class="breadcrumb-menu-2 d-flex justify-content-center">
                                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                                            <ul class="trail-items-2">
                                                <li class="trail-item-2 trail-begin"><a href="{{ route('home') }}"><span>Beranda</span></a></li>
                                                <li class="trail-item-2 trail-center"><a href="{{ route('news') }}"><span>Berita</span></a></li>
                                                <li class="trail-item-2 trail-end"><span>${res.data.title}</span></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                `);
                        $('#list_news_blog').append(`
                    <div class="df-blog-details__wrap">
                        <div class="df-blog-details__box mb-30 wow fadeInUp animated" data-wow-duration="1.5s" data-wow-delay="0.3">
                            <div class="df-blog-details__thumb p-relative">
                                <div class="df-blog-details__thumb-overlay wow"></div>
                                <img src="{{ asset('${res.data.image}') }}" alt="image not found">
                            </div>
                            <div class="df-blog-details__content mb-40">
                                <div class="df-blog-details__meta mb-25">
                                    <span><i class="fa-thin fa-calendar-days"></i>
                                        ${moment(res.data.date).format('ll')}
                                    </span>
                                </div>
                                <p class="df-blog-details__text mb-20">${res.data.header_content}</p>
                                <div class="df-blog-details__thumb-wrap">
                                    <div class="df-blog-details__thumb2 p-relative mb-30">
                                        <div class="df-blog-details__thumb-overlay wow"></div>
                                        <img src="{{ asset('${res.data.news_image_detail[0].file_name}') }}" alt="image not found">
                                    </div>
                                    <div class="df-blog-details__thumb2 p-relative mb-30">
                                        <div class="df-blog-details__thumb-overlay wow"></div>
                                        <img src="{{ asset('${res.data.news_image_detail[1].file_name}') }}" alt="image not found">
                                    </div>
                                </div>
                                <p class="df-blog-details__text mb-35">
                                    ${res.data.content}
                                </p>
                            </div>
                        </div>
                    </div>
                `);
                    } else {
                        // Tampilkan daftar berita
                        if (res.data.length !== 0) {
                            $('#load_more_news').show();
                            $.each(res.data, function(i, news) {
                                $('#list_news_blog').append(`
                    <div class="df-blog__box each_news" data-id="${news.id}" style="cursor: pointer !important;">
                        <div class="df-blog__thumb">
                            <img src="{{ asset('${news.image}') }}" alt="image not found">
                        </div>
                        <div class="df-blog__content">
                            <div class="df-blog__meta">
                                <span class="tag">${news.category.name}</span>
                                <span class="blog-date">${moment(news.date).format('ll')}</span>
                            </div>
                            <h3 class="df-blog__title">${news.title}</h3>
                            <p>${news.short_desc}</p>
                        </div>
                    </div>
                `);
                            });
                            offset_data += limit_fetch;
                        } else {
                            $('#load_more_news').hide();
                        }
                    }
                }
            });
        }

        $(document).on('click', '.each_news', function(e) {
            e.preventDefault();
            let news_id = $(this).data('id');
            fetchNews(news_id);
        });


        function fetchNewsCategories() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-news-categories') }}',
                type: 'GET',
                dataType: 'json',
                async: true,
                success: function(res) {
                    $('#list_news_category').empty()
                    $.each(res.data, function(i, category) {
                        $('#list_news_category').append(`
                            <li class="list_category" data-category_id="${category.id}" style="cursor: pointer !important; hover: #C21010 !important;">
                                <a href="#">${category.name}</a>
                            </li>
                        `)
                    })
                }
            })
        }

        function fetchRecentNews() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-news-recent-post') }}',
                type: 'GET',
                dataType: 'json',
                async: true,
                success: function(res) {
                    $('#list_recent_post_news').empty()
                    $.each(res.data, function(i, post) {
                        $('#list_recent_post_news').append(`
                        <div class="blog-sideber-meta mb-25 each_recent_post" data-id="${post.id}" style="cursor: pointer !important;">
                            <div class="col blog-sideber-img">
                                <a href="#"><img src="{{ asset('${post.image}') }}"
                                        alt="blog-meta"></a>
                            </div>
                            <div class="col blog-sideber-text">
                                <div class="df-blog3__meta">
                                    <span class="blog-date">${moment(post.date).format('ll')}</span>
                                </div>
                                <h4>
                                    ${post.title}
                                </h4>
                            </div>
                        </div>
                        `)
                    })
                }
            })
        }

        $(document).on('click', '#load_more_news', function() {
            fetchNews()
        })

        $(document).on('click', '.list_category', function(e) {
            // e.preventDefault()
            let category_id = $(this).data('category_id')
            $('#list_news_blog').empty()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-news') }}',
                type: 'GET',
                data: {
                    category: category_id
                },
                dataType: 'json',
                async: true,
                beforeSend: function() {
                    $('#loading_animation_product').show()
                    $('#load_more_news').hide()
                },
                success: function(res) {
                    $('#list_news_blog').empty()
                    $('#loading_animation_product').hide()
                    if (res.data.length != 0) {
                        $.each(res.data, function(i, news) {
                            $('#list_news_blog').append(`
                            <div class="df-blog__box each_news" data-id="${news.id}" style="cursor: pointer !important;">
                                <div class="df-blog__thumb">
                                    <a href="">
                                        <img src="{{ asset('${news.image}') }}" alt="image not found">
                                    </a>
                                </div>
                                <div class="df-blog__content">
                                    <div class="df-blog__meta">
                                        <a href="#"><span class="tag">${news.category.name}</span></a>
                                        <span class="blog-date">${moment(news.date).format('ll')}</span>
                                    </div>
                                    <h3 class="df-blog__title">
                                        <a href="#">
                                            ${news.title}
                                        </a>
                                    </h3>
                                    <p>${news.short_desc}</p>
                                    <div class="df-blog__btn">
                                        <a href="#" class="primary-btn">Read More
                                            <span class="icon__box">
                                                <img class="icon__first" src="{{ asset('assets/img/icon/arrow-black.webp') }}"
                                                    alt="image not found">
                                                <img class="icon__second" src="{{ asset('assets/img/icon/arrow-theme.png') }}"
                                                    alt="image not found">
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            `)
                        })

                        // $('#load_more_news').show()
                    } else {
                        $('#list_news_blog').append(`<section class="df-error__area">
            <div class="container">
                <div class="row align-items-center justify-content-center section-title-spacing wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-xl-8">
                        <div class="df-error__thumb">
                            <img src="{{ asset('storage/uploads/html/404-v1-red.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center section-title-spacing wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-lg-5">
                        <div class="df-error__area-btn text-center wow fadeInUp" data-wow-delay=".3s">
                            <a href="{{ route('news') }}" class="primary-btn hover-white">Go Back
                                <span class="icon__box">
                                    <img class="icon__first" src="{{ asset('assets/img/icon/arrow-white.webp') }}"
                                        alt="image not found">
                                    <img class="icon__second" src="{{ asset('assets/img/icon/arrow-black.webp') }}"
                                        alt="image not found">
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>`)
                    }
                    $('#load_more_news').hide()
                }
            })
        })

        $(document).on('click', '#submit_search', function(e) {
            e.preventDefault()
            let search = $('#search_news').val()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-news') }}',
                type: 'GET',
                data: {
                    search: search,
                    init_search: 1
                },
                dataType: 'json',
                async: true,
                beforeSend: function() {
                    $('#loading_animation_product').show()
                    $('#load_more_news').hide()
                },
                success: function(res) {
                    $('#list_news_blog').empty()
                    $('#loading_animation_product').hide()
                    if (res.data.length != 0) {
                        $.each(res.data, function(i, news) {
                            $('#list_news_blog').append(`
                            <div class="df-blog__box each_news" data-id="${news.id}" style="cursor: pointer !important;">
                                <div class="df-blog__thumb">
                                    <a href="">
                                        <img src="{{ asset('${news.image}') }}" alt="image not found">
                                    </a>
                                </div>
                                <div class="df-blog__content">
                                    <div class="df-blog__meta">
                                        <a href="#"><span class="tag">${news.category.name}</span></a>
                                        <span class="blog-date">${moment(news.date).format('ll')}</span>
                                    </div>
                                    <h3 class="df-blog__title">
                                        <a href="#">
                                            ${news.title}
                                        </a>
                                    </h3>
                                    <p>${news.short_desc}</p>
                                    <div class="df-blog__btn">
                                        <a href="#" class="primary-btn">Read More
                                            <span class="icon__box">
                                                <img class="icon__first" src="{{ asset('assets/img/icon/arrow-black.webp') }}"
                                                    alt="image not found">
                                                <img class="icon__second" src="{{ asset('assets/img/icon/arrow-theme.png') }}"
                                                    alt="image not found">
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            `)
                        })

                        // $('#load_more_news').show()
                    } else {
                        $('#list_news_blog').append(`<section class="df-error__area section-spacing">
                            <div class="container">
                                <div class="row align-items-center justify-content-center section-title-spacing wow fadeInUp" data-wow-delay=".3s">
                                    <div class="col-xl-8">
                                        <div class="df-error__thumb">
                                            <img src="{{ asset('storage/uploads/html/404-v1-red.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center justify-content-center section-title-spacing wow fadeInUp" data-wow-delay=".3s">
                                    <div class="col-lg-5">
                                        
                                        <div class="df-error__area-btn text-center wow fadeInUp" data-wow-delay=".3s">
                                            <a href="{{ route('news') }}" class="primary-btn hover-white">Go Back
                                                <span class="icon__box">
                                                    <img class="icon__first" src="{{ asset('assets/img/icon/arrow-white.webp') }}"
                                                        alt="image not found">
                                                    <img class="icon__second" src="{{ asset('assets/img/icon/arrow-black.webp') }}"
                                                        alt="image not found">
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>`)
                    }
                    $('#load_more_news').hide()
                }
            })
        })

        $(document).on('click', '.each_recent_post', function() {
            let news_id = $(this).data('id')
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-news-detail') }}',
                type: 'GET',
                data: {
                    id: news_id
                },
                dataType: 'json',
                async: true,
                beforeSend: function() {
                    $('#loading_animation_product').show()
                    $('#load_more_news').hide()
                },
                success: function(res) {
                    $('#header_news').hide()
                    $('#list_news_blog').empty()
                    $('#header_detail_news').empty()
                    $('#header_detail_news').append(`
                        <section class="page-title-area-2 breadcrumb-spacing bg-theme-4 section-spacing">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-9">
                                        <div class="page-title-wrapper-2 text-center">
                                            <h1 class="page__title-2 mb-25">${res.data.title}</h1>
                                            <div class="breadcrumb-menu-2 d-flex justify-content-center">
                                                <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                                                    <ul class="trail-items-2">
                                                        <li class="trail-item-2 trail-begin"><a href="{{ route('home') }}"><span>Beranda</span></a></li>
                                                        <li class="trail-item-2 trail-center"><a href="{{ route('news') }}"><span>Berita</span></a></li>
                                                        <li class="trail-item-2 trail-end"><span>${res.data.title}</span></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    `)
                    $('#loading_animation_product').hide()
                    if (res.data.length != 0) {
                        // alert(res.data.image_detail.length)
                        $('#list_news_blog').append(`
                            <div class="df-blog-details__wrap">
                                <div class="df-blog-details__box mb-30 wow fadeInUp animated" data-wow-duration="1.5s" data-wow-delay="0.3">
                                    <div class="df-blog-details__thumb p-relative">
                                        <div class="df-blog-details__thumb-overlay wow"></div>
                                        <img src="{{ asset('${res.data.image}') }}" alt="image not found">
                                    </div>
                                    <div class="df-blog-details__content mb-40">
                                        <div class="df-blog-details__meta mb-25">
                                            <span><i class="fa-thin fa-calendar-days"></i>
                                                ${moment(res.data.date).format('ll')}
                                            </span>
                                        </div>
                                        <p class="df-blog-details__text mb-20">${res.data.header_content}</p>
                                        <div class="df-blog-details__thumb-wrap">
                                            <div class="df-blog-details__thumb2 p-relative mb-30">
                                                <div class="df-blog-details__thumb-overlay wow"></div>
                                                <img src="{{ asset('${res.data.news_image_detail[0].file_name}') }}" alt="image not found">
                                            </div>
                                            <div class="df-blog-details__thumb2 p-relative mb-30">
                                                <div class="df-blog-details__thumb-overlay wow"></div>
                                                <img src="{{ asset('${res.data.news_image_detail[1].file_name}') }}" alt="image not found">
                                            </div>
                                        </div>
                                        <p class="df-blog-details__text mb-35">
                                            ${res.data.content}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        `)
                    } else {
                        $('#list_news_blog').append(`<section class="df-error__area section-spacing">
                            <div class="container">
                                <div class="row align-items-center justify-content-center section-title-spacing wow fadeInUp" data-wow-delay=".3s">
                                    <div class="col-xl-8">
                                        <div class="df-error__thumb">
                                            <img src="{{ asset('storage/uploads/html/404-v1-red.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center justify-content-center section-title-spacing wow fadeInUp" data-wow-delay=".3s">
                                    <div class="col-lg-5">
                                        
                                        <div class="df-error__area-btn text-center wow fadeInUp" data-wow-delay=".3s">
                                            <a href="{{ route('news') }}" class="primary-btn hover-white">Go Back
                                                <span class="icon__box">
                                                    <img class="icon__first" src="{{ asset('assets/img/icon/arrow-white.webp') }}"
                                                        alt="image not found">
                                                    <img class="icon__second" src="{{ asset('assets/img/icon/arrow-black.webp') }}"
                                                        alt="image not found">
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>`)
                    }
                    $('#load_more_news').hide()
                }
            })
        })

        $("form").bind("keypress", function(e) {
            if (e.keyCode == 13) {
                return false;
            }
        });
    })
</script>
