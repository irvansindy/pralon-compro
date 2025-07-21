<script>
    $(document).ready(function() {
        function submitDownload(formData, modalId, successMessage) {
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: '{{ route('log-user') }}',
                type: 'post',
                data: formData,
                dataType: 'json',
                success: function(res) {
                    window.open(res.data.download_url, '_blank');
                    $(modalId).modal('hide');
                    toastr.info(
                        `<p style="font-size: 16px; color: white;">${successMessage}</p>`,
                        '<p style="font-size: 16px; font-weight: bold; color: white;">Sukses</p>',
                        { timeOut: 10000 }
                    );
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText);
                    toastr.error(
                        `<p style="font-size:16px; color:white;">${response_error.meta.message}</p>`,
                        '<p style="font-size:16px; font-weight:bold; color:white;">Error</p>',
                        { timeOut: 5000 }
                    );
                }
            });
        }

        $(document).on('click', '#btn_download_brocure', function(e) {
            e.preventDefault()
            let id = $(this).data('id')
            let brocure = $(this).data('brocure')
            // alert(brocure)
            $('#submit_download_brocure').attr('data-product_id', id)
            $('#submit_download_brocure').attr('data-product_brocure', brocure)
        })
        
        $(document).on('click', '#btn_download_pricelist', function(e) {
            e.preventDefault()
            let id = $(this).data('id')
            let pricelist = $(this).data('pricelist')
            // alert(pricelist)
            $('#submit_download_pricelist').attr('data-product_id', id)
            $('#submit_download_pricelist').attr('data-product_pricelist', pricelist)
        })

        $(document).on('click', '#submit_download_brocure', function(e) {
            e.preventDefault();
            let formData = {
                id: $(this).data('product_id'),
                name: $('#fullname_brocure').val(),
                phone_number: $('#phone_brocure').val(),
                email: $('#email_brocure').val(),
                type: 'brocure'
            };
            submitDownload(formData, '#confirm_download_brocure', 'Berhasil download brosur');
        });

        $(document).on('click', '#submit_download_pricelist', function(e) {
            e.preventDefault();
            let formData = {
                id: $(this).data('product_id'),
                name: $('#fullname_pricelist').val(),
                phone_number: $('#phone_pricelist').val(),
                email: $('#email_pricelist').val(),
                type: 'pricelist'
            };
            submitDownload(formData, '#confirm_download_pricelist', 'Berhasil download daftar harga');
        });
    })
</script>
