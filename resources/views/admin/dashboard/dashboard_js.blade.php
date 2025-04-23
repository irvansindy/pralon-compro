<script src="https://cdn.jsdelivr.net/npm/jvectormap@1.2.2/jquery-jvectormap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jvectormap@1.2.2/tests/assets/jquery-jvectormap-world-mill-en.js"></script>

<script>
    $(document).ready(() => {
        getDashboardData();
        setInterval(() => {
            getDashboardData();
        }, 60000);

        function getDashboardData() {
            $.ajax({
                url: "{{ route('fetch-dashboard') }}",
                type: "GET",
                success: function (response) {
                    $('#total_users').text(response.data.subcriber);
                    $('#total_download_brocure').text(response.data.download_brocure);
                    $('#total_download_pricelist').text(response.data.download_pricelist);
                    $('#total_message_email').text(response.data.contact);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching dashboard data:", error);
                }
            });
        }
        
    })
    $('#world-map').vectorMap({
        map: 'world_mill_en',
        backgroundColor: '#f4f4f4',
        regionStyle: {
            initial: {
                fill: '#d2d6de'
            },
            hover: {
                fill: '#00a65a'
            }
        },
        markerStyle: {
            initial: {
                fill: '#00a65a',
                stroke: '#111'
            }
        },
        markers: [
            {latLng: [37.77, -122.41], name: 'San Francisco'},
            {latLng: [51.5, -0.12], name: 'London'},
            {latLng: [-6.2, 106.8], name: 'Jakarta'},
            {latLng: [35.68, 139.69], name: 'Tokyo'}
        ]
    });
</script>