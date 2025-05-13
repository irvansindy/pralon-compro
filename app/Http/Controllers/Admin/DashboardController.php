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
use App\Events\VisitorLogged;
use Jenssegers\Agent\Agent;
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
    public function broadcastVisitors(Request $request)
    {
        $agent = new Agent();
        $ip = $request->ip();
        $country = $request->input('country', 'Unknown');
        $region = $request->input('region', 'Unknown');
        $city = $request->input('city', 'Unknown');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $browser = $agent->browser();
        $platform = $agent->platform();
        $device = $agent->device();

        $existing = VisitorLogs::where('ip', $ip)
            ->where('city', $city)
            ->where('country', $country)
            ->where('region', $region)
            ->where('latitude', $latitude)
            ->where('longitude', $longitude)
            ->where('browser', $browser)
            ->where('platform', $platform)
            ->where('device', $device)
            ->where('visited_at', '>=', now()->subMinutes(5))
            ->first();
            
        if (!$existing) {
            $visitor = VisitorLogs::create([
                'ip' => $ip,
                'country' => $country,
                'region' => $region,
                'city' => $city,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'browser' => $browser,
                'platform' => $platform,
                'device' => $device,
                'user_agent' => $request->userAgent(),
                'visited_at' => now()
            ]);

            broadcast(new VisitorLogged([$visitor]));
        }
        return FormatResponseJson::success(true, 'Broadcasted successfully');
    }

}
