<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Helpers\SecurityLogHelper;
use Illuminate\Support\Facades\Log;
use App\Events\SecurityAlertEvent;
use App\Helpers\FormatResponseJson;
use App\Models\BlockedRequest;
use GeoIP;
use Jenssegers\Agent\Agent;
use UAParser\Parser;
class SecurityLogController extends Controller
{
    public function index()
    {
        return view('admin.security-logs.index');
    }
    public function getLogs()
    {
        $logPath = storage_path('logs/blocked_requests.log');
        $logs = [];

        if (file_exists($logPath)) {
            foreach (file($logPath, FILE_IGNORE_NEW_LINES) as $line) {
                $decoded = json_decode($line, true);
                if ($decoded) {
                    $logs[] = [
                        'time'       => $decoded['time'] ?? '-',
                        'type'       => $decoded['type'] ?? '-',
                        'ip'         => $decoded['ip'] ?? '-',
                        'user_agent' => $decoded['user_agent'] ?? '-',
                        'url'        => $decoded['url'] ?? '-',
                        'extra'      => $decoded['extra'] ?? '-',
                    ];
                }
            }
        }
        // return FormatResponseJson::success($logs, 'Log aktivitas keamanan berhasil dimuat.');
        return FormatResponseJson::success(BlockedRequest::all(), 'Log aktivitas keamanan berhasil dimuat.');
    }
    // public function testAlert()
    // {
    //     // 🌐 Ambil IP publik valid
    //     $ip = $this->getRealIp(request());

    //     // 📦 Parse User-Agent pakai Jenssegers Agent
    //     $agent = new Agent();
    //     $agent->setUserAgent(request()->userAgent());
    //     $uaData = [
    //         'raw'       => request()->userAgent(),
    //         'browser'   => $agent->browser() . ' ' . $agent->version($agent->browser()),
    //         'os'        => $agent->platform() . ' ' . $agent->version($agent->platform()),
    //         'device'    => $agent->device() ?: 'Unknown',
    //         'is_mobile' => $agent->isMobile(),
    //         'is_tablet' => $agent->isTablet(),
    //         'is_robot'  => $agent->isRobot(),
    //     ];

    //     // 📍 GeoIP lookup
    //     $geo = geoip($ip);

    //     // 📝 Data yang akan disimpan
    //     $logData = [
    //         'type'        => 'TEST_ALERT',
    //         'ip'          => $ip,
    //         'country'     => $geo->country ?? null,
    //         'city'        => $geo->city ?? null,
    //         'state'       => $geo->state_name ?? null,
    //         'timezone'    => $geo->timezone ?? null,
    //         'lat'         => $geo->lat ?? null,
    //         'lon'         => $geo->lon ?? null,
    //         // 'user_agent'  => json_encode($uaData),
    //         'user_agent'  => [
    //                             'raw'       => request()->userAgent(),
    //                             'browser'   => $agent->browser() . ' ' . $agent->version($agent->browser()),
    //                             'os'        => $agent->platform() . ' ' . $agent->version($agent->platform()),
    //                             'device'    => $agent->device() ?: 'Unknown',
    //                             'is_mobile' => $agent->isMobile(),
    //                             'is_tablet' => $agent->isTablet(),
    //                             'is_robot'  => $agent->isRobot(),
    //                         ],
    //         'url'         => request()->fullUrl(),
    //         'extra'       => ['info' => 'Simulasi alert dari controller'],
    //         'time'        => now()->toDateTimeString(),
    //     ];

    //     // 📝 Simpan ke DB
    //     BlockedRequest::create($logData);

    //     // 📂 Simpan ke log file
    //     Log::channel('security')->warning('Test Alert', $logData);

    //     // 📢 Broadcast ke Super Admin Dashboard
    //     broadcast(new SecurityAlertEvent($logData))->toOthers();

    //     return FormatResponseJson::success(null, '🚨 Test alert berhasil dikirim ke Super Admin.');
    // }

    /**
     * Ambil IP publik valid (even behind proxy)
     */
    
    public function testAlert()
    {
        // 🌐 Ambil IP publik valid
        $ip = $this->getRealIp(request());

        // 📝 Buat log data pakai helper (DRY)
        $logData = SecurityLogHelper::createLogData('TEST_ALERT', [
            'info' => 'Simulasi alert dari controller'
        ]);

        // 📝 Simpan ke DB
        BlockedRequest::create($logData);

        // 📂 Simpan ke log file
        Log::channel('security')->warning('Test Alert', $logData);

        // 📢 Broadcast ke Super Admin Dashboard
        broadcast(new SecurityAlertEvent($logData))->toOthers();

        return FormatResponseJson::success(null, '🚨 Test alert berhasil dikirim ke Super Admin.');
    }

    private function getRealIp($request): string
    {
        $headers = [
            'CF-Connecting-IP',
            'X-Real-IP',
            'X-Forwarded-For',
            'Forwarded',
        ];

        foreach ($headers as $header) {
            if ($request->headers->has($header)) {
                $ips = explode(',', $request->header($header));
                foreach ($ips as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                        return $ip;
                    }
                }
            }
        }

        return $request->ip();
    }


    private function extractJson($line)
    {
        $start = strpos($line, '{');
        if ($start !== false) {
            return substr($line, $start);
        }
        return '{}';
    }
    public function fetchGeoLocation()
    {
        try {
            
            $ip_location = geoip()->getLocation('103.19.110.137');
            
            return FormatResponseJson::success($ip_location, 'GeoIP location fetched successfully.');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 400);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
}
