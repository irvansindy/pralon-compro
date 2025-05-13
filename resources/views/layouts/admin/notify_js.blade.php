<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    $(document).ready(function () {
        Pusher.logToConsole = false;

        const pusher = new Pusher('e11c2a2751e267a88130', {
            cluster: 'ap1',
            forceTLS: true
        });

        const channel = pusher.subscribe('admin-notification');

        channel.bind('new-notification', function(data) {
            console.log('📩 Received new-notification', data);

            let notif = data.notification ?? data;
            console.log('🧾 Parsed Notif:', notif);

            // Hapus "No new notifications" jika ada
            $('.notification-list p.text-center.text-muted.mt-3').remove();

            // Tambahkan notifikasi baru
            let html = `
                <a href="${notif.url}" class="dropdown-item d-flex align-items-start">
                    <i class="${notif.icon ?? 'fas fa-envelope fa-fw'} text-primary mr-2"></i>
                    <div>
                        <small class="text-muted d-block">${notif.time}</small>
                        <p class="mb-0">${notif.message}</p>
                    </div>
                </a>
            `;
            $('.notification-list').prepend(html);

            // Update badge
            let badge = $('#notification-admin');
            let count = parseInt(badge.text()) || 0;
            badge.text(count + 1);
            badge.fadeOut(100).fadeIn(100);
        });

        // channel.bind_global(function(eventName, data) {
        //     console.log('🌐 Global Event:', eventName, data);
        // });

        function fetchNotifications() {
            $.ajax({
                url: '/admin/notifications',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    updateNotificationUI(data.data);
                },
                error: function (xhr, status, error) {
                    console.error('Gagal fetch notifikasi:', error);
                }
            });
        }

        function updateNotificationUI(notifications) {
            const listContainer = $('.notification-list');
            const badge = $('#notification-admin');

            listContainer.empty();

            if (notifications.length === 0) {
                listContainer.html('<p class="text-center text-muted mt-3">No new notifications</p>');
                badge.text('0');
            } else {
                let unreadCount = 0;

                notifications.forEach(function (notif) {
                    const readClass = notif.read_at ? 'text-muted' : 'fw-bold';
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

        // Load saat awal
        fetchNotifications();

        // Clear Notifikasi
        $('#clear-notifications').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/admin/notifications/read-all',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    fetchNotifications();
                }
            });
        });

        // Tandai semua dibaca saat klik dropdown
        $('#alertsDropdownLogDownload').on('click', function () {
            $.ajax({
                url: '/admin/notifications/read-all',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    $('#notification-admin').text('0');
                }
            });
        });
    });
</script>