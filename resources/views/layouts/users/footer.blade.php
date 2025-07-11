<!-- footer-area-start -->
<footer>
    <section class="df-footer__area section-spacing-top bg-theme-4">
        <div class="df-newsletter__area p-relative">
            <div class="container">
                <div class="df-newsletter__wrapper">
                    <div class="row g-5 align-items-center mb-60">
                        <div class="col-xl-7 col-lg-6 col-md-6">
                            <div class="df-footer__logo mb-30">
                                <a href="#"><img src="{{ asset('assets/img/logo/pralon.png') }}"
                                        alt="image not found"></a>
                            </div>
                            <p class="df-footer-text" style="font-size: 16px !important;">
                                Pralon adalah merek dagang dari pipa uPVC berkualitas tinggi yang di produksi oleh PT
                                Pralon. Pralon telah lama dikenal sejak tahun 1963 sebagai pelopor dalam industri pipa
                                uPVC di Indonesia.
                            </p>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-6">
                            <div class="df-newsletter__content">
                                <h2 class="df-newsletter__title mb-40 lh-1">Connect With Us!</h2>
                                <div class="df-newsletter__form">
                                    <form action="#">
                                        @csrf
                                        <div class="df-input-field">
                                            <input type="text" id="email_subcription" name="email_subcription"
                                                placeholder="Enter email address">
                                            
                                        </div>
                                        <div class="df-newsletter__form-btn">
                                            <button type="button" class="primary-btn hover-white"
                                                id="submit_email_subcription">
                                                <div id="icon-for-submit">
                                                    Connect
                                                    <span class="icon__box">
                                                        <img class="icon__first"
                                                            src="{{ asset('assets/img/icon/arrow-white.webp') }}"
                                                            alt="image not found">
                                                        <img class="icon__second"
                                                            src="{{ asset('assets/img/icon/arrow-black.webp') }}"
                                                            alt="image not found">
                                                    </span>
                                                </div>
                                                <!-- Spinner -->
                                                <div id="spinner" style="display: none; margin-top: 10px;">
                                                    <span style="display: inline-block; width: 20px; height: 20px; border: 2px solid #ccc; border-top-color: #333; border-radius: 50%; animation: spin 0.8s linear infinite;"></span>
                                                </div>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- horizontal line start  -->
        <div class="container">
            <div class="hr1"></div>
        </div>
        <!-- horizontal line end  -->

        <div class="footer__widgets-area">
            <div class="container">
                <div class="footer__widgets-wrapper widgets-5">
                    <div class="footer__widget">
                        <h4 class="footer__widget-title">Social Links</h4>
                        <div class="social-links">
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/Pralon.official" target="_blank"><i
                                            class="icon-023-facebook-app-symbol"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/pralon_official" target="_blank"><i
                                            class="icon-025-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/@ptpralon-official5154" target="_blank"><i
                                            class="fa-brands fa-youtube"></i></a>
                                </li>
                                <li>
                                    <a href="http://tiktok.com/@pralonofficial" target="_blank"><i
                                            class="fa-brands fa-tiktok"></i></a>
                                </li>
                                <li>
                                    <a href="http://linkedin.com/company/pt-pralon" target="_blank"><i
                                            class="fa-brands fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- horizontal line start  -->
    <div class="bg-theme-4">
        <div class="container">
            <div class="hr1"></div>
        </div>
    </div>
    <!-- horizontal line end  -->

    <div class="copyright__area p-relative bg-theme-4">
        <div class="container">
            <div class="copyright-content__wrapper">
                <div class="copyright__text text-center">
                    <p>
                        All Rights Reserved by Pralon Indonesia
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer-area-end -->

<!-- back to top start -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path fill="#C21010" d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!-- back to top end -->
<!-- Spinner Animation Style -->
<style>
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
<script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script>
    $('#subscription-message').text('')
    let debounceTimer = null;
    let lastRequestTime = 0;
    const rateLimitDelay = 5000; // 5 detik delay antara request

    $('#submit_email_subcription').click(function () {
        let email = $('#email_subcription').val().trim();
        let spinner = $('#spinner');
        let icon = $('#icon-for-submit');

        // Regex untuk validasi email sederhana
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Frontend validation
        if (email === '') {
            toastr.error(
                '<p style="font-size: 16px !important; color: white !important;">Email tidak boleh kosong.</p>',
                '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Validasi</p>',
                { timeOut: 5000 }
            );
            return;
        }

        if (!emailRegex.test(email)) {
            toastr.error(
                '<p style="font-size: 16px !important; color: white !important;">Format email tidak valid.</p>',
                '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Validasi</p>',
                { timeOut: 5000 }
            );
            return;
        }

        // Rate limiting frontend (anti spam request setiap 5 detik)
        const now = Date.now();
        if (now - lastRequestTime < rateLimitDelay) {
            toastr.warning(
                '<p style="font-size: 16px !important; color: white !important;">Tunggu sebentar sebelum mencoba lagi.</p>',
                '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Terlalu Cepat</p>',
                { timeOut: 4000 }
            );
            return;
        }
        lastRequestTime = now;

        // Debounce (anti multiple klik dalam 300ms)
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            $('#submit_email_subcription').prop('disabled', true);
            icon.hide();
            spinner.show();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('store-email-subcription') }}",
                type: "POST",
                data: {
                    email: email,
                },
                success: function (res) {
                    $('#email_subcription').val('');
                    toastr.info(
                        '<p style="font-size: 16px !important; color: white !important;">' + res.meta.message + '</p>',
                        '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Sukses</p>',
                        { timeOut: 10000 }
                    );
                },
                error: function (xhr) {
                    let response_error = JSON.parse(xhr.responseText);
                    let errorMsg = response_error?.meta?.message?.errors?.email || 'Terjadi kesalahan. Coba lagi.';
                    toastr.error(
                        '<p style="font-size: 16px !important; color: white !important;">' + errorMsg + '</p>',
                        '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Error</p>',
                        { timeOut: 5000 }
                    );
                },
                complete: function () {
                    // Reset button & spinner
                    $('#submit_email_subcription').prop('disabled', false);
                    spinner.hide();
                    icon.show();
                }
            });
        }, 300); // debounce delay
    });


</script>
