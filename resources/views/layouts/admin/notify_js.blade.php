<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = false;

    var pusher = new Pusher('e11c2a2751e267a88130', {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('admin-notification');

    channel.bind('new-notification', function(data) {
        let notif = data.notification;
        let html = `
            <div class="dropdown-item">
                <small class="text-muted">${new Date(notif.created_at).toLocaleString()}</small>
                <p>${notif.message}</p>
            </div>
        `;
        $('.notification-list').prepend(html);
        let badge = $('#notification-admin');
        let count = parseInt(badge.text()) || 0;
        badge.text(count + 1);
    });

    $(document).ready(function() {
        function fetchNotifications() {
            $.ajax({
                url: '/admin/notifications',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    updateNotificationUI(data.data);
                },
                error: function(xhr, status, error) {
                    console.error('Gagal fetch notifikasi:', error);
                }
            });
        }

        function updateNotificationUI(notifications) {
            console.log(notifications);
            
            let listContainer = $('.notification-list');
            let badge = $('#notification-admin');

            listContainer.empty();

            if (notifications.length === 0) {
                listContainer.html('<p class="text-center text-muted mt-3">No new notifications</p>');
                badge.text('0');
            } else {
                let unreadCount = 0;

                notifications.forEach(function(notif) {
                    const readClass = notif.read_at ? 'text-muted' : 'font-weight-bold';
                    if (!notif.read_at) unreadCount++;

                    listContainer.append(`
                        <div class="dropdown-item ${readClass}">
                            <small class="text-muted">${new Date(notif.created_at).toLocaleString()}</small>
                            <p>${notif.message}</p>
                        </div>
                    `);
                });

                badge.text(unreadCount);
            }
        }

        // Ambil saat halaman dimuat
        fetchNotifications();

        // Clear notif
        $('#clear-notifications').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/admin/notifications/read-all',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    $('.notification-list').html('<p class="text-center text-muted mt-3">No new notifications</p>');
                    // $('#notification-admin').text('0');
                    fetchNotifications();

                }
            });
        });

        // Tandai semua dibaca saat dropdown dibuka
        $('#alertsDropdownLogDownload').on('click', function() {
            $.ajax({
                url: '/admin/notifications/read-all',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    $('#notification-admin').text('0');
                }
            });
        });
    });
</script>
