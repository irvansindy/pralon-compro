<script>
    $('#product_id_filter_brocure').select2()
    $('#product_id_filter_pricelist').select2()
    $(document).ready(function() {
        var savedNotifCount = localStorage.getItem('download_notification_count');

        if (savedNotifCount) {
            $('#notification-admin').text(savedNotifCount);
        }

        var pusher = new Pusher('e11c2a2751e267a88130', {
            cluster: 'ap1',
            forceTLS: true
        });

        var channel = pusher.subscribe('download-channel');

        channel.bind('new-download', function(data) {
            var totalNotif = data.countBrocure + data.countPricelist;
            
            // Simpan jumlah notifikasi ke localStorage
            localStorage.setItem('download_notification_count', totalNotif);
            
            $('#notification-admin').text(totalNotif);
        });
        $('#apply_filter_brocure').on('click', function() {
            fetchHistoryDownloadBrocure();
        });
        
        $('#apply_filter_pricelist').on('click', function() {
            fetchHistoryDownloadPricelist();
        });
        
        fetchHistoryDownloadBrocure();
        fetchHistoryDownloadPricelist();
        
        function fetchHistoryDownloadBrocure() {
            let product_id = $('#product_id_filter_brocure').val();
            let start_date_brocure = $('#start_date_brocure').val();
            let end_date_brocure = $('#end_date_brocure').val();
            $.ajax({
                url: "{{ route('fetch-history-download-brocure') }}",
                type: "GET",
                data: { 
                    product_id: product_id,
                    start_date_brocure: start_date_brocure,
                    end_date_brocure: end_date_brocure,
                },
                success: function(res) {
                    $('#table_history_download_brocure').DataTable().clear().destroy()
                    $('#table_history_download_brocure tbody').empty()
                    const data = res.data
                    data.forEach((item, index) => {
                        $('#table_history_download_brocure tbody').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.name}</td>
                                <td>${item.email}</td>
                                <td>${item.type_download}</td>
                                <td>
                                    <button type="button" class="btn btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        `)
                    })
                    $('#table_history_download_brocure').DataTable()
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function fetchHistoryDownloadPricelist() {
            let product_id = $('#product_id_filter_pricelist').val();
            let start_date_pricelist = $('#start_date_pricelist').val();
            let end_date_pricelist = $('#end_date_pricelist').val();
            $.ajax({
                url: "{{ route('fetch-history-download-pricelist') }}",
                type: "GET",
                data: { 
                    product_id: product_id,
                    start_date_pricelist: start_date_pricelist,
                    end_date_pricelist: end_date_pricelist,
                },
                success: function(res) {
                    $('#table_history_download_pricelist').DataTable().clear().destroy()
                    $('#table_history_download_pricelist tbody').empty()
                    const data = res.data
                    data.forEach((item, index) => {
                        $('#table_history_download_pricelist tbody').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.name}</td>
                                <td>${item.email}</td>
                                <td>${item.type_download}</td>
                                <td>
                                    <button type="button" class="btn btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        `)
                    })
                    $('#table_history_download_pricelist').DataTable()
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        $('#export_excel_brocure').click(function() {
            let product_id = $('#product_id_filter_brocure').val();
            let start_date = $('#start_date_brocure').val();
            let end_date = $('#end_date_brocure').val();

            window.location.href = "{{ route('export-history-brocure') }}?product_id=" + product_id + "&start_date_brocure=" + start_date + "&end_date_brocure=" + end_date;
        });

        $('#export_excel_pricelist').click(function() {
            let product_id = $('#product_id_filter_pricelist').val();
            let start_date = $('#start_date_pricelist').val();
            let end_date = $('#end_date_pricelist').val();

            window.location.href = "{{ route('export-history-pricelist') }}?product_id=" + product_id + "&start_date_pricelist=" + start_date + "&end_date_pricelist=" + end_date;
        });
    });
</script>
