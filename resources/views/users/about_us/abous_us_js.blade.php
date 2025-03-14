<script>
    $(document).ready(function() {
        fetchContentAboutUs();

        function fetchContentAboutUs() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-content-about-us') }}',
                type: 'GET',
                success: function(res) {
                    let history = res.data.history != null ? res.data.history : '';
                    let why_pralon = res.data.why != null ? res.data.why : '';
                    let vision = res.data.visi_misi != null ? res.data.visi_misi : '';
                    let value_pralon = res.data.value != null ? res.data.value : '';
                    let certificates = res.data.certificates != null ? res.data.certificates : '';
                    // header
                    $('#thumbnail_video').attr('src', history.source_thumbnail_video)
                    $('#link_video').attr('href', history.source_video)
                    $('#history_title').html(history.title)
                    $('#history_subtitle').html(history.subtitle)
                    $('#history_desc').html(history.desc)
                    // why reason
                    $('#why_title').html(why_pralon.title)
                    $('#why_subtitle').html(why_pralon.subtitle)
                    $('#why_desc').html(why_pralon.desc)
                    $('#pralon_point_plus_list').empty()
                    $.each(why_pralon.detail, function(i, data) {
                        $('#pralon_point_plus_list').append(`
                            <div class="col-xl-6 col-md-6">
                                <div class="df-benifits__single-box">
                                    <div class="df-benifits__icon">
                                        <i class="${data.icon}"></i>
                                    </div>
                                    <div class="df-benifits__content">
                                        <h4 class="df-benifits__title">${data.title}</h4>
                                        <p class="df-benifits__sub-title">${data.desc}</p>
                                    </div>
                                </div>
                            </div>
                        `)
                    });
                    // vision
                    let url_visi_image = '{{ asset('') }}'+vision.image
                    $('#visi_background').css('background-image', `url('${url_visi_image}')`);
                    $('#visi_text').html(vision.text)
                    // mision
                    $('#list_misi').empty()
                    $.each(vision.mision, function(i, data) {
                        $('#list_misi').append(`
                            <li>
                                <p>${data.text}</p>
                            </li>
                        `);
                    });
                    // value
                    $('.list_value_pralon').empty()
                    $.each(value_pralon, function(i, data) {
                        $('.list_value_pralon').append(`
                            <li>
                                <span class="list-icon">
                                    <i class="${data.icon}"></i>
                                </span>
                                <p>${data.name}</p>
                            </li>
                        `);
                    });
                    // certificate
                    $('.certificate_carousel_icon').empty();
                    $.each(certificates, (i, certificate) => {
                        $('.certificate_carousel_icon').append(`
                            <div class="swiper-slide">
                                <div class="brand__item">
                                    <img src="{{ asset('${certificate.icon}') }}" alt="image not found">
                                </div>
                            </div>
                        `);
                    })
                    setTimeout(() => {
                        console.log("Swiper initializing...");
                        initSwiper();
                    }, 300);
                }
            })
        }
    });
    var swiper = new Swiper('.slider_certificates', {
        loop: true, // Aktifkan loop untuk infinite slider
        autoplay: {
            delay: 2000, // Durasi antar slide (ms)
            disableOnInteraction: true, // Tetap autoplay meskipun ada interaksi
        },
        spaceBetween: 30, // Jarak antar slide
        breakpoints: {
            // Breakpoint untuk layar kecil (mobile)
            480: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            // Breakpoint untuk tablet
            768: {
                slidesPerView: 3,
                spaceBetween: 15,
            },
            // Breakpoint untuk layar besar (desktop)
            1024: {
                slidesPerView: 5,
                spaceBetween: 20,
            },
        },
        slidesPerView: 5,
        direction: 'horizontal',
        // direction: getDirection(),
        // on: {
        //     resize: function() {
        //         swiper.changeDirection(getDirection());
        //     },
        // },
    });

    function getDirection() {
        var windowWidth = window.innerWidth;
        var direction = window.innerWidth <= 760 ? 'vertical' : 'horizontal';

        return direction;
    }
    // swiper.autoplay.reverseDirection = true;
</script>
