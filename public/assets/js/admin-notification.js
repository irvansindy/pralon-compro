const receivedNotifications = new Set();
let notificationCache = [];
let notificationLoaded = false;
let lastNotificationId = null;
let nextPageUrl = "/admin/notifications";
let loadingMore = false;
const STORAGE_KEY = "admin_notifications_v1";

function saveCache() {
    localStorage.setItem(
        STORAGE_KEY,
        JSON.stringify({
            data: notificationCache,
            saved_at: Date.now(),
        })
    );
}

function loadCache() {
    const raw = localStorage.getItem(STORAGE_KEY);
    if (!raw) return false;

    try {
        const cache = JSON.parse(raw);

        // cache max 5 menit
        if (Date.now() - cache.saved_at > 5 * 60 * 1000) {
            localStorage.removeItem(STORAGE_KEY);
            return false;
        }

        notificationCache = cache.data || [];
        renderFromCache();
        updateUnreadBadge();
        return true;
    } catch {
        localStorage.removeItem(STORAGE_KEY);
        return false;
    }
}

function isToday(dateString) {
    const date = new Date(dateString);
    const today = new Date();

    return (
        date.getDate() === today.getDate() &&
        date.getMonth() === today.getMonth() &&
        date.getFullYear() === today.getFullYear()
    );
}

function normalizeNotification(raw) {
    if (!raw) return null;

    // handle payload dari Echo
    if (raw.notification) {
        raw = raw.notification;
    }

    if (!raw.id || !raw.data) return null;

    return {
        id: raw.id, // UUID notification
        data: raw.data,
        icon: raw.data.icon || "bell",
        read_at: raw.read_at ?? null,
        // created_at: raw.created_at || "just now",
        created_at: new Date().toISOString(),
    };
}

/* ================= RENDER ================= */
function renderNotificationItem(notification, isNew = false) {
    return `
        <a href="/admin/notifications/${notification.id}" class="dropdown-item d-flex align-items-center notification-item ${!notification.read_at ? "notification-unread" : ""} ${isNew ? "notification-new" : ""}" data-id="${notification.id}">
            <div class="mr-3">
                <div class="icon-circle bg-primary">
                    <i class="fas fa-${notification.icon || "bell"} text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500">${notification.created_at}</div>
                <span class="${!notification.read_at ? "font-weight-bold" : ""}">
                    ${notification.data.message}
                </span>
            </div>
        </a>
    `;
}

/* ================= LOAD ================= */
function loadNotifications(force = false) {
    if (loadingMore || !nextPageUrl) return;

    loadingMore = true;
    $(".notification-loader").removeClass("d-none");

    $.get(nextPageUrl, (res) => {
        const normalized = (res.data || [])
            .map(normalizeNotification)
            .filter(Boolean);

        notificationCache.push(...normalized);
        nextPageUrl = res.next_page;

        renderFromCache();
        updateUnreadBadge();
        saveCache();
    }).always(() => {
        loadingMore = false;
        $(".notification-loader").addClass("d-none");
    });
}

/* ================= BADGE ================= */

function updateBadge() {
    const badge = $("#notification-admin");
    const count = notificationCache.length;

    count > 0
        ? badge.text(count).removeClass("d-none")
        : badge.addClass("d-none");
}

function updateUnreadBadge() {
    const unread = notificationCache.filter((n) => !n.read_at).length;
    const badge = $("#notification-admin");

    unread > 0
        ? badge.text(unread).removeClass("d-none")
        : badge.addClass("d-none");
}

function playNotificationSound() {
    const sound = document.getElementById("notificationSound");
    if (sound) sound.play().catch(() => {});
}

// function renderFromCache() {
//     const container = $(".notification-list");
//     container.empty();

//     const today = [];
//     const earlier = [];

//     notificationCache.forEach((n) => {
//         String(n.created_at).includes("lalu") ||
//         String(n.created_at).includes("ago")
//             ? today.push(n)
//             : earlier.push(n);
//     });

//     if (today.length) {
//         container.append('<div class="dropdown-header">Today</div>');
//         today.forEach((n) => container.append(renderNotificationItem(n)));
//     }

//     if (earlier.length) {
//         container.append('<div class="dropdown-header">Earlier</div>');
//         earlier.forEach((n) => container.append(renderNotificationItem(n)));
//     }
// }
function renderFromCache() {
    const container = $(".notification-list");
    container.empty();

    const today = [];
    const earlier = [];

    notificationCache.forEach((n) => {
        if (isToday(n.created_at)) {
            today.push(n);
        } else {
            earlier.push(n);
        }
    });

    if (today.length) {
        container.append('<div class="dropdown-header">Today</div>');
        today.forEach((n) =>
            container.append(renderNotificationItem(n))
        );
    }

    if (earlier.length) {
        container.append('<div class="dropdown-header">Earlier</div>');
        earlier.forEach((n) =>
            container.append(renderNotificationItem(n))
        );
    }
}


/* ================= REALTIME ================= */
function listenNotifications() {
    if (!window.Echo || !window.AUTH_USER_ID) return;

    window.Echo.private(`App.Models.User.${window.AUTH_USER_ID}`).listen(
        ".Illuminate\\Notifications\\Events\\BroadcastNotificationCreated",
        (e) => {
            const n = normalizeNotification(e);

            if (!n) {
                console.warn("Invalid notification payload", e);
                return;
            }

            // anti duplicate (UUID based)
            if (receivedNotifications.has(n.id)) return;
            receivedNotifications.add(n.id);

            notificationCache.unshift(n);
            updateUnreadBadge();
            playNotificationSound();
            saveCache();
            if (
                $("#alertsDropdownLogDownload").attr("aria-expanded") === "true"
            ) {
                $(".notification-list").prepend(
                    renderNotificationItem(n, true),
                );
            }

            if (n.data.popup) {
                toastr.info(n.data.message, n.data.title || "Notification");
            }
        },
    );
}

/* ================= INIT ================= */

$(document).ready(function () {
    loadCache();
    listenNotifications();

    $("#alertsDropdownLogDownload").on("click", function () {
        loadNotifications();
    });

    $.get("/admin/notifications/unread-count", (res) => {
        if (res.count > 0) {
            $("#notification-admin").text(res.count).removeClass("d-none");
        }
    });

    $(document).on("click", ".notification-item", function (e) {
        const el = $(this);
        const id = el.data("id");
        // UI langsung update
        el.removeClass("notification-unread");
        el.find("span").removeClass("font-weight-bold");

        // update cache
        const n = notificationCache.find((n) => n.id === id);
        if (n) n.read_at = true;

        updateBadge();
        updateUnreadBadge();
        saveCache();

        // backend
        $.post(`/admin/notifications/${id}/read`, {
            _token: $('meta[name="csrf-token"]').attr("content"),
        });
    });

    $("#markAllRead").on("click", function (e) {
        e.preventDefault();

        // UI
        $(".notification-item")
            .removeClass("notification-unread")
            .find("span")
            .removeClass("font-weight-bold");

        notificationCache.forEach((n) => (n.read_at = true));
        updateUnreadBadge();
        saveCache();

        // backend
        $.post("/admin/notifications/mark-all-read", {
            _token: $('meta[name="csrf-token"]').attr("content"),
        });
    });

    $(".notification-list").on("scroll", function () {
        const el = $(this);
        if (el.scrollTop() + el.innerHeight() >= el[0].scrollHeight - 50) {
            loadNotifications();
        }
    });
});
