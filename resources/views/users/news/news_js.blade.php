<script>
    $(document).ready(function() {
        var offset_data = 0;
        var limit_fetch = 3;
        // $('#loading_animation_product').hide()
        fetchNews()
        fetchNewsCategories()
        fetchRecentNews()

        function fetchNews() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("fetch-news") }}',
                type: 'GET',
                data: { 
                    offset: offset_data,
                    limit: limit_fetch
                },
                dataType: 'json',
                async: true,
                beforeSend: function() {
                    $('#loading_animation_product').show()
                    $('#load_more_news').hide()
                },
                success: function(res) {
                    $('#loading_animation_product').hide()
                    if (res.data.length != 0) {
                        $('#load_more_news').show()
                        $.each(res.data, function(i, news) {
                            $('#list_news_blog').append(`
                            <div class="df-blog__box each_news" data-id="${news.id}" style="cursor: pointer !important;">
                                <div class="df-blog__thumb">
                                    <a href="">
                                        <img src="{{ asset('assets/img/pralon/news_blog/${news.image}') }}" alt="image not found">
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
                        offset_data += limit_fetch
                        
                    } else {
                        $('#load_more_news').hide()
                    }
                    // alert(offset_data)
                }
            })
        }
        
        function fetchNewsCategories() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("fetch-news-categories") }}',
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
                url: '{{ route("fetch-news-recent-post") }}',
                type: 'GET',
                dataType: 'json',
                async: true,
                success: function(res) {
                    $('#list_recent_post_news').empty()
                    $.each(res.data, function(i, post) {
                        $('#list_recent_post_news').append(`
                        <div class="blog-sideber-meta mb-25 each_recent_post" data-id="${post.id}" style="cursor: pointer !important;">
                            <div class="col blog-sideber-img">
                                <a href="#"><img src="{{ asset('assets/img/pralon/news_blog/${post.image}') }}"
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

        $(document).on('click','#load_more_news', function() {
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
                url: '{{ route("fetch-news") }}',
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
                                        <img src="{{ asset('assets/img/pralon/news_blog/${news.image}') }}" alt="image not found">
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
                        $('#list_news_blog').append(`<p class="text-center">Data tidak ditemukan</p>`)
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
                url: '{{ route("fetch-news") }}',
                type: 'GET',
                data: { 
                    search: search
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
                                        <img src="{{ asset('assets/img/pralon/news_blog/${news.image}') }}" alt="image not found">
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
                        $('#list_news_blog').append(`<p class="text-center">Data tidak ditemukan</p>`)
                    }
                    $('#load_more_news').hide()
                }
            })
        })

        $(document).on('click', '.each_news', function(e) {
            e.preventDefault()
            let news_id = $(this).data('id')
            // alert(news_id)
            // window.location.href = 'fetch-news-detail?id='+news_id;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("fetch-news-detail") }}',
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
                                        <img src="{{ asset('assets/img/pralon/news_blog/${res.data.image}') }}" alt="image not found">
                                    </div>
                                    <div class="df-blog-details__content mb-40">
                                        <div class="df-blog-details__meta mb-25">
                                            <span><i class="fa-thin fa-calendar-days"></i>
                                                ${moment(res.data.date).format('ll')}
                                            </span>
                                        </div>
                                        <div class="df-blog-details__thumb-wrap">
                                            <div class="df-blog-details__thumb2 p-relative mb-30">
                                                <div class="df-blog-details__thumb-overlay wow"></div>
                                                <img src="{{ asset('assets/img/pralon/news_blog/details/${res.data.image_detail[0].file_name}') }}" alt="image not found">
                                            </div>
                                            <div class="df-blog-details__thumb2 p-relative mb-30">
                                                <div class="df-blog-details__thumb-overlay wow"></div>
                                                <img src="{{ asset('assets/img/pralon/news_blog/details/${res.data.image_detail[1].file_name}') }}" alt="image not found">
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
                        $('#list_news_blog').append(`<p class="text-center">Data tidak ditemukan</p>`)
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
                url: '{{ route("fetch-news-detail") }}',
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
                                        <img src="{{ asset('assets/img/pralon/news_blog/${res.data.image}') }}" alt="image not found">
                                    </div>
                                    <div class="df-blog-details__content mb-40">
                                        <div class="df-blog-details__meta mb-25">
                                            <span><i class="fa-thin fa-calendar-days"></i>
                                                ${moment(res.data.date).format('ll')}
                                            </span>
                                        </div>
                                        <div class="df-blog-details__thumb-wrap">
                                            <div class="df-blog-details__thumb2 p-relative mb-30">
                                                <div class="df-blog-details__thumb-overlay wow"></div>
                                                <img src="{{ asset('assets/img/pralon/news_blog/details/${res.data.image_detail[0].file_name}') }}" alt="image not found">
                                            </div>
                                            <div class="df-blog-details__thumb2 p-relative mb-30">
                                                <div class="df-blog-details__thumb-overlay wow"></div>
                                                <img src="{{ asset('assets/img/pralon/news_blog/details/${res.data.image_detail[1].file_name}') }}" alt="image not found">
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
                        $('#list_news_blog').append(`<p class="text-center">Data tidak ditemukan</p>`)
                    }
                    $('#load_more_news').hide()
                }
            })
        })
    })
</script>