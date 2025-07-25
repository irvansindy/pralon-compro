<?php

namespace App\Helpers;

use Jenssegers\Agent\Agent;
use Torann\GeoIP\Facades\GeoIP;
class SecurityLogHelper
{
    public static function createLogData(string $type, array $extra = []): array
    {
        $request = request();
        $agent = new Agent();
        // $geo = geoip($request->ip());
        // $geo = GeoIP::setCache('none')->getLocation($request->ip());
        $ip = $request->ip();
        $response = @file_get_contents("https://ipapi.co/{$ip}/json/");
        $data = json_decode($response, true);
        $geo = [
            'ip'       => $ip,
            'country'  => $data['country_name'] ?? null,
            'city'     => $data['city'] ?? null,
            'state'    => $data['region'] ?? null,
            'lat'      => $data['latitude'] ?? null,
            'lon'      => $data['longitude'] ?? null,
        ];
        return [
            'type'        => $type,
            'ip'          => $request->ip(),
            'country'     => $geo['country'] ?? null,
            'city'        => $geo['city'] ?? null,
            'state'       => $geo['state'] ?? null,
            'timezone'    => $geo['timezone'] ?? null,
            'lat'         => $geo['lat'] ?? null,
            'lon'         => $geo['lon'] ?? null,
            'user_agent'  => [
                'raw'       => $request->userAgent(),
                'browser'   => $agent->browser() . ' ' . $agent->version($agent->browser()),
                'os'        => $agent->platform() . ' ' . $agent->version($agent->platform()),
                'device'    => $agent->device() ?: 'Unknown',
                'is_mobile' => $agent->isMobile(),
                'is_tablet' => $agent->isTablet(),
                'is_robot'  => $agent->isRobot(),
            ],
            'url'         => $request->fullUrl(),
            'extra'       => $extra,
            'time'        => now()->toDateTimeString(),
        ];
    }
}
