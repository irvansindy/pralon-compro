<script>
    $(document).ready(function() {
        /**
         * Reusable AJAX Form Submit Handler
         * @param {string} formId - ID dari form (misal: '#form_master_news_blog')
         * @param {string} submitBtnId - ID dari tombol submit (misal: '#submit_news_blog')
         * @param {string} url - Endpoint route Laravel (misal: '{{ route('store-news-blog') }}')
         * @param {string} tableId - ID DataTable yang perlu direload setelah sukses
         * @param {function} extraValidation - Callback custom validation (return true/false)
         */
        function handleAjaxFormSubmit({
            formId,
            submitBtnId,
            url,
            tableId,
            extraValidation = null
        }) {
            $(document).on('click', submitBtnId, function(e) {
                e.preventDefault();
                let form = $(formId)[0];
                let formData = new FormData(form);

                // Reset error message
                $('.error-message').text('');
                let isValid = true;

                function showError(field, message) {
                    $('#message_' + field).text(message);
                    isValid = false;
                }

                // Sanitizer + validation dasar
                function validateField(id, name) {
                    let val = sanitizeInput($(id).val());
                    if (val === '') showError(name, 'Field ini tidak boleh kosong');
                    if (hasXSS(val)) showError(name, 'Input tidak boleh mengandung script/tag HTML');
                    if (hasSQLi(val)) showError(name, 'Input tidak valid');
                    $(id).val(val);
                }

                // File validation
                function validateFile(inputId, name) {
                    let file = $(inputId)[0].files[0];
                    if (file) {
                        if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                            showError(name, 'Format harus jpg, jpeg, atau png');
                        } else if (file.size > 10 * 1024 * 1024) {
                            showError(name, 'Ukuran maksimal 10MB');
                        }
                    }
                }

                // Jalankan custom validation kalau ada
                if (typeof extraValidation === 'function') {
                    let extraValid = extraValidation({
                        validateField,
                        validateFile,
                        showError
                    });
                    if (!extraValid) isValid = false;
                }

                if (!isValid) return;

                // Loading UI
                $(formId).hide();
                $('#loading_' + formId.replace('#', '')).html(`
            <div class="d-flex justify-content-center my-4">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                </div>
            </div>
        `);

                // AJAX Request
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $('#loading_' + formId.replace('#', '')).empty();
                        $(formId).show();
                        $(formId).closest('.modal').modal('hide');
                        if (tableId) $(tableId).DataTable().ajax.reload();

                        Swal.fire({
                            icon: "success",
                            title: 'Success!',
                            text: res.meta.message,
                        });
                    },
                    error: function(xhr) {
                        $('#loading_' + formId.replace('#', '')).empty();
                        $(formId).show();
                        let response_error = JSON.parse(xhr.responseText);
                        if (response_error.meta.code === 422) {
                            $.each(response_error.meta.message.errors, function(i, value) {
                                $('#message_' + i.replace('.', '_')).text(value);
                            });
                        } else {
                            toastr.error(
                                '<p style="font-size: 16px; color: white;">' +
                                response_error.meta.message + '</p>',
                                '<p style="font-size: 16px; font-weight: bold; color: white;">Error</p>', {
                                    timeOut: 5000
                                });
                        }
                    }
                });
            });
        }

        // Helper untuk sanitize string input
        function sanitizeInput(value) {
            // Hapus tag HTML/JS
            return $('<div>').text(value).html().trim();
        }

        // Helper untuk cek XSS attempt
        function hasXSS(value) {
            const xssPattern = /<script.*?>.*?<\/script>|javascript:|on\w+=|<.*?on\w+=.*?>|<iframe.*?>|<img.*?src=.*?>|<object.*?>|<embed.*?>|<svg.*?>/gi;
            return xssPattern.test(value);
        }

        // Helper untuk cek SQL injection attempt
        function hasSQLi(value) {
            const sqliPattern = /(union\s+select|select\s.*from|insert\s+into|drop\s+table|update\s+\w+\s+set|delete\s+from|--|#|;)/gi;
            return sqliPattern.test(value);
        }
    });
</script>
