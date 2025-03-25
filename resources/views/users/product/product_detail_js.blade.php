<script>
    $(document).ready(function() {
        // global notify
        // Pusher.logToConsole = true;

        // var pusher = new Pusher('e11c2a2751e267a88130', {
        //     cluster: 'ap1',
        //     forceTLS: true
        // });
        
        // var channel = pusher.subscribe('download-channel');

        // channel.bind('new-download', function(data) {
        //     var totalNotif = data.countBrocure + data.countPricelist;
            
        //     // Simpan jumlah notifikasi ke localStorage
        //     localStorage.setItem('download_notification_count', totalNotif);

        //     // Cek apakah elemen #notification-admin ada di halaman ini
        //     if ($('#notification-admin').length) {
        //         $('#notification-admin').text(totalNotif);
        //     }
        // });

        $(document).on('click', '#btn_download_brocure', function(e) {
            e.preventDefault()
            let id = $(this).data('id')
            let brocure = $(this).data('brocure')
            // alert(brocure)
            $('#submit_download_brocure').attr('data-product_id', id)
            $('#submit_download_brocure').attr('data-product_brocure', brocure)
        })

        $(document).on('click', '#submit_download_brocure', function(e) {
            e.preventDefault()
            var fullname_brocure = $('#fullname_brocure').val()
            var phone_brocure = $('#phone_brocure').val()
            var email_brocure = $('#email_brocure').val()
            var product_id = $(this).data('product_id')
            var product_brocure = $(this).data('product_brocure')
            var url_brocure = $(this).data('url_brocure')
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('log-user') }}',
                type: 'post',
                data: {
                    id: product_id,
                    name: fullname_brocure,
                    phone_number: phone_brocure,
                    email: email_brocure,
                    product_brocure: product_brocure,
                    type: 'brocure',
                },
                dataType: 'json',
                async: true,
                success: function(res) {
                    window.open(url_brocure, '_blank')
                    $('#confirm_download_brocure').modal('hide');
                    toastr.info(
                        '<p style="font-size: 16px !important; color: white !important;">Berhasil download brosur</p>',
                        '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Sukses</p>', {
                            timeOut: 10000
                        })
                },
                error: function(xhr, status, error) {
                    let response_error = JSON.parse(xhr.responseText)
                    toastr.error(
                        '<p style="font-size: 16px !important; color: white !important;">' +
                        response_error.meta.message + '</p>',
                        '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Error</p>', {
                            timeOut: 5000
                        })
                }
            })
        })
        
        $(document).on('click', '#btn_download_pricelist', function(e) {
            e.preventDefault()
            let id = $(this).data('id')
            let pricelist = $(this).data('pricelist')
            // alert(pricelist)
            $('#submit_download_pricelist').attr('data-product_id', id)
            $('#submit_download_pricelist').attr('data-product_pricelist', pricelist)

        })

        $(document).on('click', '#submit_download_pricelist', function(e) {
            e.preventDefault()
            var fullname_pricelist = $('#fullname_pricelist').val()
            var phone_pricelist = $('#phone_pricelist').val()
            var email_pricelist = $('#email_pricelist').val()
            var product_id = $(this).data('product_id')
            var product_pricelist = $(this).data('product_pricelist')
            var url_pricelist = $(this).data('url_pricelist')
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('log-user') }}',
                type: 'post',
                data: {
                    id: product_id,
                    name: fullname_pricelist,
                    phone_number: phone_pricelist,
                    email: email_pricelist,
                    product_pricelist: product_pricelist,
                    type: 'pricelist',
                },
                dataType: 'json',
                async: true,
                success: function(res) {
                    window.open(url_pricelist, '_blank')
                    $('#confirm_download_pricelist').modal('hide');

                    toastr.info(
                        '<p style="font-size: 16px !important; color: white !important;">Berhasil download daftar harga</p>',
                        '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Sukses</p>', {
                            timeOut: 10000
                        })
                },
                error: function(xhr, status, error) {
                    // Handle error
                    let response_error = JSON.parse(xhr.responseText)
                    toastr.error(
                        '<p style="font-size: 16px !important; color: white !important;">' +
                        response_error.meta.message + '</p>',
                        '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Error</p>', {
                            timeOut: 5000
                        })
                }
            })
        })
    })
</script>
