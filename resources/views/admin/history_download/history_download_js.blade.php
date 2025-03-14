<script>
    $(document).ready(function() {
        fetchHistoryDownloadBrocure()
        function fetchHistoryDownloadBrocure() {
            $.ajax({
                url: "{{ route('fetch-history-download-brocure') }}",
                type: "GET",
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
            $.ajax({
                url: "{{ route('fetch-history-download-pricelist') }}",
                type: "GET",
                success: function(res) {
                    $('#table_history_download_pricelist').DataTable().clear().destroy()
                    $('#table_history_download_pricelist tbody').empty()
                    $('#table_product_pricelist_by_id').DataTable()
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    });
</script>