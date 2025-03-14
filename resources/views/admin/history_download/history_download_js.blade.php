<script>
    $('#product_id_filter_brocure').select2()
    $('#product_id_filter_pricelist').select2()
    $(document).ready(function() {
        $('#product_id_filter_brocure').on('change', function() {
            fetchHistoryDownloadBrocure();
        });
        
        $('#product_id_filter_pricelist').on('change', function() {
            fetchHistoryDownloadPricelist();
        });
        
        fetchHistoryDownloadBrocure();
        fetchHistoryDownloadPricelist();
        
        function fetchHistoryDownloadBrocure() {
            let product_id = $('#product_id_filter_brocure').val();
            $.ajax({
                url: "{{ route('fetch-history-download-brocure') }}",
                type: "GET",
                data: { product_id: product_id },
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
            $.ajax({
                url: "{{ route('fetch-history-download-pricelist') }}",
                type: "GET",
                data: { product_id: product_id },
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
    });
</script>
