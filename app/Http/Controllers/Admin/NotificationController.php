<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Helpers\FormatResponseJson;
class NotificationController extends Controller
{
    public function index()
    {
        return view("admin.notification.index");
    }
}
