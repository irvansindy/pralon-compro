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

        // send-email-contact-us
        $(document).on('click', '.df-booking2__form-btn button', function() {
            var name = $('#name').val()
            var email = $('#email').val()
            var phone_number = $('#phone_number').val()
            var type_service = $('#type_service').val()
            var message = $('#message_contact').val()
            let formData = new FormData($('#form_contact_us')[0])
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
                // data: formData,
                dataType: 'json',
                async: true,
                success: function(res) {
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                    $('#message_name').text('')
                    $('#message_email').text('')
                    $('#message_phone_number').text('')
                    $('#message_type_service').text('')
                    $('#message_message_contact').text('')
                },
                error: function(xhr) {
                    // var res = xhr.responseJSON
                    let response_error = JSON.parse(xhr.responseText)
                    $('#message_name').text('')
                    $('#message_email').text('')
                    $('#message_phone_number').text('')
                    $('#message_type_service').text('')
                    $('#message_message_contact').text('')
                    if (response_error.meta.code == 422) {
                        $.each(response_error.meta.message.errors, function(i, value) {
                            $('#message_' + i.replace('.', '_')).text(value)
                        })
                    } else {
                        toastr.error(
                            '<p style="font-size: 16px !important; color: white !important;">' +
                            response_error.meta.message + '</p>',
                            '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Error</p>', {
                                timeOut: 5000
                            })
                    }
                }
            })
            // if (name == '' || email == '' || number == '' || service == '' || message == '') {
            //     alert('Data tidak boleh kosong')
            // } else {
            // }
        })
    })
</script>