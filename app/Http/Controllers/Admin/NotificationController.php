<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Helpers\FormatResponseJson;
class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->paginate(10);

        return response()->json([
            'data' => $notifications->map(fn ($n) => [
                'id'        => $n->id,
                'icon'      => $n->data['icon'] ?? 'bell',
                'read_at'   => $n->read_at,
                'created_at'=> $n->created_at->diffForHumans(),
                'data'      => $n->data,
            ]),
            'next_page' => $notifications->nextPageUrl()
        ]);
    }


    public function unreadCount()
    {
        return response()->json([
            'count' => auth()->user()->unreadNotifications()->count()
        ]);
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        $notification->markAsRead();

        return response()->json(['status' => 'ok']);
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return response()->json(['status' => 'ok']);
    }

    public function show($id)
    {
        $notification = auth()->user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        // auto mark as read
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return view('admin.notification.show', [
            'notification' => $notification,
            'actionUrl' => $notification->data['url'] ?? null
        ]);
    }

}
