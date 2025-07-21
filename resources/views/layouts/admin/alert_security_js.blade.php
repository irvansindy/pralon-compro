<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    $(document).ready(function () {
        Pusher.logToConsole = false;

        const pusher = new Pusher('e11c2a2751e267a88130', {
            cluster: 'ap1',
            forceTLS: true
        });

        const channel = pusher.subscribe('admin-notification');
        const securityChannel = pusher.subscribe('private-super-admin.alerts');

        /**
         * 📩 Handler untuk general notification (download, contact, dll)
         */
        channel.bind('new-notification', function (data) {
            console.log('📩 Received general notification:', data);
            handleIncomingNotification(data.notification ?? data, 'primary');
        });

        /**
         * 🚨 Handler untuk security alert
         */
        securityChannel.bind('security.alert', function (data) {
            console.log('🚨 Received security alert:', data);
            handleIncomingNotification({
                time: data.alert.time,
                message: `[${data.alert.type}] ${data.alert.ip} - ${data.alert.extra.info ?? 'Security alert detected'}`,
                url: data.alert.url,
                icon: 'fas fa-shield-alt text-danger'
            }, 'danger');
        });

        /**
         * 🧾 Fungsi untuk menambahkan notifikasi ke UI
         */
        function handleIncomingNotification(notif, type) {
            // Hapus "No new notifications" jika ada
            $('.notification-list p.text-center.text-muted.mt-3').remove();

            // Tambahkan notifikasi baru
            let html = `
                <a href="${notif.url ?? '#'}" class="dropdown-item d-flex align-items-start">
                    <i class="${notif.icon ?? (type === 'danger' ? 'fas fa-shield-alt text-danger' : 'fas fa-envelope text-primary')} mr-2"></i>
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
        }

        /**
         * 🚀 Fetch semua notifikasi (general + security)
         */
        function fetchNotifications() {
            $.ajax({
                url: '/admin/notifications',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    updateNotificationUI(data.data);
                },
                error: function (xhr, status, error) {
                    console.error('❌ Gagal fetch notifikasi:', error);
                }
            });
        }

        /**
         * 📝 Render semua notifikasi ke dropdown
         */
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
                        <a href="${notif.url ?? '#'}" class="dropdown-item d-flex align-items-start ${readClass}">
                            <i class="${notif.icon ?? 'fas fa-bell text-secondary'} mr-2"></i>
                            <div>
                                <small class="text-muted d-block">${new Date(notif.created_at).toLocaleString()}</small>
                                <p class="mb-0">${notif.message}</p>
                            </div>
                        </a>
                    `);
                });

                badge.text(unreadCount);
            }
        }

        // 🔄 Load saat awal
        fetchNotifications();

        // ✅ Clear semua notifikasi
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

        // 📝 Tandai semua dibaca saat klik dropdown
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
