<script>
    $(document).ready(function() {
        $(document).on('click', '#btn_download_brocure', function(e) {
            e.preventDefault()
            let id = $(this).data('id')
            let brocure = $(this).data('brocure')
            // alert(brocure)
            $('#submit_download_brocure').attr('data-product_id',id)
            $('#submit_download_brocure').attr('data-product_brocure',brocure)
        })
        
        $(document).on('click', '#btn_download_pricelist', function(e) {
            e.preventDefault()
            let id = $(this).data('id')
            let pricelist = $(this).data('pricelist')
            // alert(pricelist)
            $('#submit_download_pricelist').attr('data-product_id',id)
            $('#submit_download_pricelist').attr('data-product_pricelist',pricelist)
            
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
                url: '{{ route("log-user") }}',
                type: 'post',
                data: {
                    id: product_id,
                    name: fullname_pricelist,
                    phone_number: phone_pricelist,
                    email: email_pricelist, 
                    product_pricelist: product_pricelist
                },
                dataType: 'json',
                async: true,
                success: function(res) {
                    window.open(url_pricelist , '_blank')
                    $('#confirm_download_pricelist').modal('hide');

                    toastr.info(
                        '<p style="font-size: 16px !important; color: white !important;">Berhasil download daftar harga</p>',
                        '<p style="font-size: 16px !important; color: white !important;">Sukses</p>',
                        {timeOut: 10000})
                },
                error: function(xhr, status, error) {
                    // Handle error
                    alert('Error downloading file: ' + error);
                }
            })
        })
        
        $(document).on('click', '#submit_download_brocure', function(e) {
            e.preventDefault()
            var fullname_brocure = $('#fullname_brocure').val()
            var phone_brocure = $('#phone_brocure').val()
            var email_brocure = $('#email_brocure').val()
            var product_id = $(this).data('product_id')
            var product_brocure = $(this).data('product_brocure')
            var url_brocure = $(this).data('url_brocure')
            // alert([product_id, product_brocure])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("log-user") }}',
                type: 'post',
                data: {
                    id: product_id,
                    name: fullname_brocure,
                    phone_number: phone_brocure,
                    email: email_brocure,
                    product_brocure: product_brocure
                },
                dataType: 'json',
                async: true,
                success: function(res) {
                    window.open(url_brocure , '_blank')
                    $('#confirm_download_brocure').modal('hide');
                    // Display an info toast with no title
                    toastr.info(
                        '<p style="font-size: 16px !important; color: white !important;">Berhasil download brosur</p>',
                        '<p style="font-size: 16px !important; color: white !important;">Sukses</p>',
                        {timeOut: 10000})
                },
                error: function(xhr, status, error) {
                    // Handle error
                    alert('Error downloading file: ' + error);
                }
            })
        })
    })
</script>
