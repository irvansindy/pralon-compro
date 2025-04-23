<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePageSectionMaster;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Models\Subcriptions;
use App\Models\ContactUs;
use App\Models\LogUserDownload;
use App\Models\VisitorLogs;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
class DashboardController extends Controller
{
    public function index()
    {
        return view("admin.dashboard.index");
    }
    public function fetch()
    {
        $data = Cache::remember('homepage_stats', now()->addMinute(), function () {
            $fromDate = Carbon::now()->subDays(30);

            return [
                'subcriber' => Subcriptions::where('is_verified', 1)
                    ->where('created_at', '>=', $fromDate)
                    ->count(),

                'download_brocure' => LogUserDownload::where('type_download', 'brocure')
                    ->where('created_at', '>=', $fromDate)
                    ->count(),

                'download_pricelist' => LogUserDownload::where('type_download', 'pricelist')
                    ->where('created_at', '>=', $fromDate)
                    ->count(),

                'contact' => ContactUs::where('created_at', '>=', $fromDate)->count(),
            ];
        });
        return FormatResponseJson::success($data, 'Data fetched successfully (last 30 days, cached)');
    }
    public function broadcastVisitors()
    {
        $recentVisitors = VisitorLogs::where('visited_at', '>=', now()->subMinutes(1))->get();

        event(new \App\Events\VisitorLogged($recentVisitors));

        return response()->json(['status' => 'broadcasted']);
    }

}
