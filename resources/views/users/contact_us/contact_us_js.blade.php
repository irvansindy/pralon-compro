<!-- select 2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // $('.nice-select').select2()
    $(document).ready(function() {
        var lebar = $(window).width()
        var tinggi = $(window).height()
        $('#message_name').text('')
        $('#message_email').text('')
        $('#message_phone_number').text('')
        $('#message_type_service').text('')
        $('#message_message_contact').text('')

        // 🛡️ Frontend Rate Limit & Debounce
        let debounceTimer = null;
        let lastContactRequest = 0;
        const contactRateLimitDelay = 5000; // 5 detik delay antar request

        $(document).on('click', '.df-booking2__form-btn button', function () {
            // 🛡️ Regex Sanitizer
            function sanitizeInput(input) {
                return input
                    .replace(/<script.*?>.*?<\/script>/gi, '') // remove script tags
                    .replace(/<[^\>]*>?/gm, '')               // remove all HTML tags
                    .replace(/['"`;]/g, '')                   // remove SQLi chars
                    .replace(/--/g, '')                       // remove SQLi comments
                    .replace(/(on\w+)=/gi, '')                 // remove inline JS events
                    .replace(/javascript:/gi, '')             // remove javascript: scheme
                    .trim();
            }

            // 🛡️ Regex untuk validasi email & phone
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let phoneRegex = /^[0-9+\-\s()]{8,20}$/; // hanya angka dan simbol telepon umum

            // 🚀 Ambil & sanitize nilai input
            let name = sanitizeInput($('#name').val());
            let email = sanitizeInput($('#email').val());
            let phone_number = sanitizeInput($('#phone_number').val());
            let type_service = sanitizeInput($('#type_service').val());
            let message = sanitizeInput($('#message_contact').val());

            // 🔥 Bersihkan pesan error lama
            $('#message_name').text('');
            $('#message_email').text('');
            $('#message_phone_number').text('');
            $('#message_type_service').text('');
            $('#message_message_contact').text('');

            // ✅ Frontend Validation
            let hasError = false;
            if (name === '') {
                $('#message_name').text('Nama tidak boleh kosong');
                hasError = true;
            }
            if (email === '') {
                $('#message_email').text('Email tidak boleh kosong');
                hasError = true;
            } else if (!emailRegex.test(email)) {
                $('#message_email').text('Format email tidak valid');
                hasError = true;
            }
            if (phone_number === '') {
                $('#message_phone_number').text('Nomor telepon tidak boleh kosong');
                hasError = true;
            } else if (!phoneRegex.test(phone_number)) {
                $('#message_phone_number').text('Nomor telepon hanya boleh angka dan simbol + - ( )');
                hasError = true;
            }
            if (type_service === '') {
                $('#message_type_service').text('Tipe layanan harus dipilih');
                hasError = true;
            }
            if (message === '') {
                $('#message_message_contact').text('Pesan tidak boleh kosong');
                hasError = true;
            }
            if (hasError) {
                return; // Stop kalau ada error
            }

            // 🛡️ Frontend Rate Limiting
            const now = Date.now();
            if (now - lastContactRequest < contactRateLimitDelay) {
                toastr.warning(
                    '<p style="font-size: 16px !important; color: white !important;">Tunggu sebentar sebelum mengirim ulang.</p>',
                    '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Terlalu Cepat</p>',
                    { timeOut: 4000 }
                );
                return;
            }
            lastContactRequest = now;

            // 🕒 Debounce Klik
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function () {
                // Disable tombol & tampilkan spinner
                let btn = $('.df-booking2__form-btn button');
                btn.prop('disabled', true).text('Mengirim...');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("send-email-contact-us") }}',
                    type: 'POST',
                    data: {
                        name: name,
                        email: email,
                        phone_number: phone_number,
                        type_service: type_service,
                        message_contact: message
                    },
                    dataType: 'json',
                    async: true,
                    success: function (res) {
                        Swal.fire({
                            icon: "success",
                            title: 'Sukses!',
                            text: res.meta.message,
                        });
                        // Reset form
                        $('#form_contact_us')[0].reset();
                    },
                    error: function (xhr) {
                        let response_error = JSON.parse(xhr.responseText);
                        if (response_error.meta.code === 422) {
                            $.each(response_error.meta.message.errors, function (i, value) {
                                $('#message_' + i.replace('.', '_')).text(value);
                            });
                        } else {
                            toastr.error(
                                '<p style="font-size: 16px !important; color: white !important;">' +
                                response_error.meta.message + '</p>',
                                '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Error</p>',
                                { timeOut: 5000 }
                            );
                        }
                    },
                    complete: function () {
                        // Enable tombol & reset text
                        btn.prop('disabled', false).text('Kirim Pesan');
                    }
                });
            }, 300); // debounce delay 300ms
        });
    })
</script>