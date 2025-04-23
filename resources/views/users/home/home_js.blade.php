<script>
    $(document).ready(function() {
        fetchAllContent()

        function fetchAllContent() {
            $.ajax({
                url: "{{ route('fetch-content-home') }}",
                type: "GET",
                success: function(res) {
                    let data = res.data
                    let products = data.some_product
                    let project_references = data.some_project_reference
                    let news_blog = data.some_news_blog
                    // fetch data product
                    $('#list_product').empty()
                    $.each(products, function(i, product) {
                        let url_detail = `/product-detail/${product.id}/${product.slug}`;
                        $('#list_product').append(`
                            <div class="swiper-slide">
                                <div class="service__box wow fadeInUp" data-wow-delay=".9s">
                                    <div class="service__content">
                                        <div class="service__img">
                                            <img src="${product.image}" alt="image not found">
                                        </div>
                                        <h4 class="service__title"><a href="${url_detail}" target="_blank" style="text-decoration:none !important; color: inherit;">${product.name}</a></h4>
                                        <p class="service__text">${product.short_desc}</p>
                                    </div>
                                </div>
                            </div>
                        `)
                    })

                    // fetch data project reference
                    $('#list_project').empty()
                    $('.all_data_project').empty()
                    $.each(project_references, function(i, project) {
                        $('#list_project').append(`
                            <div class="swiper-slide">
                                <div class="df-portfolio__item-box">
                                    <div class="df-portfolio__item-thumb" data-project_id="${project.id}" data-project_title="${project.title}">
                                        <a href="/new/${project.id}"><img src="${project.image}"alt="image not found"></a>
                                    </div>
                                    <div class="df-portfolio__item-content" data-project_id="${project.id}" data-project_title="${project.title}">
                                        <div class="df-portfolio__item-info">
                                            <h4 class="df-portfolio__item-title"><a href="#" id="project_detail_${project.id}" data-project_id="${project.id}">${project.title}</a></h4>
                                            <span class="tag">${project.short_desc}</span>
                                        </div>
                                        <div class="df-portfolio__item-btn">
                                            <a href="#" class="circle-btn is-red" data-project_id="${project.id}" data-project_title="${project.title}">
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

                    $('.all_data_project').html(`
                        <button class="primary-btn hover-white link_data_project" data-category="Project References">Selengkapnya
                            <span class="icon__box">
                                <img class="icon__first" src="{{ asset('assets/img/icon/arrow-white.webp') }}" alt="image not found">
                                <img class="icon__second" src="{{ asset('assets/img/icon/arrow-black.webp') }}" alt="image not found">
                            </span>
                        </button>
                    `)

                    // fetch data news blog
                    $('#list_berita').empty()
                    $.each(news_blog, function(i, news) {
                        // <span class="blog-date">${moment(news.date).format('DD-MM-YYYY')}</span>
                        $('#list_berita').append(`
                            <div class="swiper-slide">
                                <div class="df-blog5__box wow fadeInUp" data-wow-delay=".5s">
                                    <div class="df-blog5__thumb image_news_blog" data-project_id="${news.id}" data-project_title="${news.title}">
                                        <img src="${news.image}" alt="image not found">
                                    </div>
                                    <div class="df-blog5__content">
                                        <div class="df-blog5__meta">
                                            <span class="blog-category"><a href="">${news.category.name}</a></span>
                                            <span class="separate"></span>
                                            <span class="blog-date">${moment(news.date).format('LL')}</span>
                                        </div>
                                        <h3 class="df-blog5__title" data-project_id="${news.id}" data-project_title="${news.title}">${news.title}</h3>
                                        <div class="meta-item">
                                            <button class="primary-btn hover-white link_news_blog" data-project_id="${news.id}" data-project_title="${news.title}">Read more
                                                <span class="icon__box">
                                                    <img class="icon__first" src="{{ asset('assets/img/icon/arrow-white.webp') }}" alt="image not found">
                                                    <img class="icon__second" src="{{ asset('assets/img/icon/arrow-black.webp') }}" alt="image not found">
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    })

                }
            });
        }

        $(document).on('click', '.df-portfolio__item-thumb a, .df-portfolio__item-btn a, .df-portfolio__item-content, .image_news_blog, .link_news_blog, .df-blog5__title, .link_data_project',function(e) {
            e.preventDefault();
            var projectId = $(this).data('project_id');
            var projectTitle = $(this).data('project_title');
            var category = $(this).data('category');

            // Jika kategori tidak kosong, enkripsi data-category saja
            if (category) {
                console.log("Kategori terdeteksi: " + category + ". Memproses enkripsi...");

                // Buat kunci rahasia acak
                var secretKey = CryptoJS.lib.WordArray.random(32);
                var secretKeyBase64 = CryptoJS.enc.Base64.stringify(secretKey);

                // Data yang akan dienkripsi
                var data = { category: category };

                // Konversi data ke JSON
                var jsonString = JSON.stringify(data);

                // Enkripsi data menggunakan AES
                var encrypted = CryptoJS.AES.encrypt(jsonString, secretKey, {
                    mode: CryptoJS.mode.ECB,
                    padding: CryptoJS.pad.Pkcs7
                }).toString();

                // Encode agar aman di URL
                var encodedEncrypted = encodeURIComponent(encrypted);
                var encodedKey = encodeURIComponent(secretKeyBase64);

                // Buat URL dengan parameter terenkripsi
                var newUrl = "/news?category=" + encodedEncrypted + "&key=" + encodedKey;

                console.log("Encrypted URL (Category):", newUrl);

                // Arahkan ke halaman baru
                window.location.href = newUrl;
                return; // Hentikan eksekusi agar tidak lanjut ke proses lainnya
            }

            if (!projectId || !projectTitle) {
                console.error("Project ID atau Project Title tidak ditemukan.");
                return;
            }
            // generate secretKey
            var secretKey = CryptoJS.lib.WordArray.random(32);
            var secretKeyBase64 = CryptoJS.enc.Base64.stringify(secretKey);

            // Data yang akan dienkripsi
            var data = {
                id: projectId,
                title: projectTitle
            };

            // Konversi data ke JSON
            var jsonString = JSON.stringify(data);

            // Enkripsi data menggunakan AES
            var encrypted = CryptoJS.AES.encrypt(jsonString, secretKey, {
                mode: CryptoJS.mode.ECB,
                padding: CryptoJS.pad.Pkcs7
            }).toString();

            // Encode agar aman di URL
            var encodedEncrypted = encodeURIComponent(encrypted);
            var encodedKey = encodeURIComponent(secretKeyBase64);

            // Buat URL dengan parameter terenkripsi
            var newUrl = "/news?q=" + encodedEncrypted + "&key=" + encodedKey;

            console.log("Encrypted URL:", newUrl);

            window.location.href = newUrl;
        });

        // $(document).on('click', '.link_data_project', function(e) {
        //     e.preventDefault();
        //     var category = $(this).data('category');
        // });
    })
    // Generate kunci rahasia secara acak (32 karakter untuk AES-256)
    function generateKey() {
        return CryptoJS.lib.WordArray.random(32).toString(CryptoJS.enc.Hex);
    }
</script>
