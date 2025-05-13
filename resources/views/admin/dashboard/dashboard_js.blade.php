<script src="https://cdn.jsdelivr.net/npm/jvectormap@1.2.2/jquery-jvectormap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jvectormap@1.2.2/tests/assets/jquery-jvectormap-world-mill-en.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
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
                success: function(response) {
                    $('#total_users').text(response.data.subcriber);
                    $('#total_download_brocure').text(response.data.download_brocure);
                    $('#total_download_pricelist').text(response.data.download_pricelist);
                    $('#total_message_email').text(response.data.contact);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching dashboard data:", error);
                }
            });
        }

        // File: dashboard_js

        $('#world-map').vectorMap({
            map: 'world_mill_en',
            backgroundColor: '#eef3f7',
            regionStyle: {
                initial: {
                    fill: '#c4c4c4'
                }
            },
            markerStyle: {
                initial: {
                    fill: '#00a65a',
                    stroke: '#111'
                }
            },
            markers: []
        });

        const mapObject = $('#world-map').vectorMap('get', 'mapObject');

        const pusher = new Pusher('e11c2a2751e267a88130', {
            cluster: 'ap1',
            forceTLS: true
        });

        const channel = pusher.subscribe('visitor-channel');

        channel.bind('visitor-map-update', function(data) {
            console.log("🛰 Data from Pusher:", data); // Debug log untuk memastikan data diterima

            mapObject.removeAllMarkers();

            if (data.visitors && data.visitors.length > 0) {
                const markers = data.visitors.map(v => {
                    console.log('🔍 Marker:', v); // Debug tiap marker

                    return {
                        latLng: [parseFloat(v.latitude), parseFloat(v.longitude)],
                        name: `${v.city}, ${v.country}`
                    };
                });

                mapObject.addMarkers(markers);
            } else {
                console.warn("⚠️ Tidak ada visitor data untuk ditampilkan.");
            }
        });

    });
</script>
