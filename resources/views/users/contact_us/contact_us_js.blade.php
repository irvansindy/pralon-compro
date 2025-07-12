<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    let lastContactRequest = 0;
    let debounceTimer = null;
    const contactRateLimitDelay = 5000; // 5 detik

    function sanitizeInput(input) {
        return input
            .replace(/<script.*?>.*?<\/script>/gi, '')
            .replace(/<[^\>]*>?/gm, '')
            .replace(/['"`;]/g, '')
            .replace(/--/g, '')
            .replace(/(on\w+)=/gi, '')
            .replace(/javascript:/gi, '')
            .trim();
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRegex = /^[+]?[0-9\s\-()]{8,15}$/;

    $(document).on('click', '.df-booking2__form-btn button', function () {
        // Reset error messages
        $('.text-danger').text('');

        // Ambil & sanitasi data
        const name = sanitizeInput($('#name').val());
        const email = sanitizeInput($('#email').val());
        const phone = sanitizeInput($('#phone_number').val());
        const type_service = sanitizeInput($('#type_service').val());
        const message = sanitizeInput($('#message_contact').val());
        const honeypot = $('#website').val(); // anti bot

        let hasError = false;

        if (honeypot !== '') {
            toastr.error('Spam alert.');
            return;
        }

        if (!name) {
            $('#message_name').text('Nama tidak boleh kosong'); hasError = true;
        }
        if (!email) {
            $('#message_email').text('Email tidak boleh kosong'); hasError = true;
        } else if (!emailRegex.test(email)) {
            $('#message_email').text('Format email tidak valid'); hasError = true;
        }
        if (!phone) {
            $('#message_phone_number').text('Nomor telepon tidak boleh kosong'); hasError = true;
        } else if (!phoneRegex.test(phone)) {
            $('#message_phone_number').text('Format nomor tidak valid'); hasError = true;
        }
        if (!type_service) {
            $('#message_type_service').text('Pilih tipe layanan'); hasError = true;
        }
        if (!message) {
            $('#message_message_contact').text('Pesan tidak boleh kosong'); hasError = true;
        }

        if (hasError) return;

        const now = Date.now();
        if (now - lastContactRequest < contactRateLimitDelay) {
            toastr.warning(
                '<p style="font-size: 16px !important; color: white;">Tunggu beberapa detik sebelum kirim ulang.</p>',
                '<p style="font-weight: bold; font-size: 16px; color: white;">Terlalu Cepat</p>',
                { timeOut: 4000 }
            );
            return;
        }
        lastContactRequest = now;

        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const btn = $('.df-booking2__form-btn button');
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Mengirim...');

            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: '{{ route("send-email-contact-us") }}',
                type: 'POST',
                data: {
                    name: name,
                    email: email,
                    phone_number: phone,
                    type_service: type_service,
                    message_contact: message
                },
                success: function (res) {
                    Swal.fire({
                        icon: "success",
                        title: 'Berhasil!',
                        text: res.meta.message,
                    });
                    $('#form_contact_us')[0].reset();
                },
                error: function (xhr) {
                    let response_error = JSON.parse(xhr.responseText);
                    if (response_error.meta?.code === 422) {
                        $.each(response_error.meta.message.errors, function (i, value) {
                            const el = $('#message_' + i.replace('.', '_'));
                            if (el.length) el.text(value);
                        });
                    } else {
                        toastr.error(
                            `<p style="font-size: 16px; color: white;">${response_error.meta?.message}</p>`,
                            `<p style="font-weight: bold; font-size: 16px; color: white;">Error</p>`,
                            { timeOut: 5000 }
                        );
                    }
                },
                complete: function () {
                    btn.prop('disabled', false).html('Kirim Pesan');
                }
            });
        }, 300);
    });
});
</script>
