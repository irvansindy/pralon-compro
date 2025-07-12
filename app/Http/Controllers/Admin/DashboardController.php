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
    try {
        $agent = new Agent();
        $ip = $request->ip();

        // ⛔ Optional rate limit per IP (1x per 5 detik)
        $rateKey = 'visitor-broadcast:' . $ip;
        if (RateLimiter::tooManyAttempts($rateKey, 12)) {
            $retryAfter = RateLimiter::availableIn($rateKey);
            return FormatResponseJson::error(null, "Terlalu sering, coba lagi dalam {$retryAfter} detik.", 429);
        }
        RateLimiter::hit($rateKey, 5);

        // 🧼 Sanitasi input
        $sanitized = [
            'country'   => strip_tags(trim($request->input('country', 'Unknown'))),
            'region'    => strip_tags(trim($request->input('region', 'Unknown'))),
            'city'      => strip_tags(trim($request->input('city', 'Unknown'))),
            'latitude'  => floatval($request->input('latitude')),
            'longitude' => floatval($request->input('longitude')),
        ];

        // ✅ Validasi input
        $validator = Validator::make($sanitized, [
            'country'   => 'nullable|string|max:100',
            'region'    => 'nullable|string|max:100',
            'city'      => 'nullable|string|max:100',
            'latitude'  => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        if ($validator->fails()) {
            return FormatResponseJson::error(null, ['errors' => $validator->errors()], 422);
        }

        // 📱 Deteksi browser & platform
        $browser  = $agent->browser();
        $platform = $agent->platform();
        $device   = $agent->device();
        $userAgent = $request->userAgent();

        // 🔁 Cek duplikat dalam 5 menit terakhir
        $existing = VisitorLogs::where('ip', $ip)
            ->where('city', $sanitized['city'])
            ->where('country', $sanitized['country'])
            ->where('region', $sanitized['region'])
            ->where('latitude', $sanitized['latitude'])
            ->where('longitude', $sanitized['longitude'])
            ->where('browser', $browser)
            ->where('platform', $platform)
            ->where('device', $device)
            ->where('visited_at', '>=', now()->subMinutes(5))
            ->first();

        // ➕ Simpan jika belum ada
        if (!$existing) {
            $visitor = VisitorLogs::create([
                'ip'         => $ip,
                'country'    => $sanitized['country'],
                'region'     => $sanitized['region'],
                'city'       => $sanitized['city'],
                'latitude'   => $sanitized['latitude'],
                'longitude'  => $sanitized['longitude'],
                'browser'    => $browser,
                'platform'   => $platform,
                'device'     => $device,
                'user_agent' => $userAgent,
                'visited_at' => now(),
            ]);

            // 📢 Broadcast ke front-end
            broadcast(new VisitorLogged([$visitor]));
        }

        return FormatResponseJson::success(true, 'Broadcasted successfully');
    } catch (\Exception $e) {
        \Log::error('broadcastVisitors error: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
            'ip'    => $request->ip(),
        ]);
        return FormatResponseJson::error(null, 'Terjadi kesalahan server', 500);
    }
}
}
