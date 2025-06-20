<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use APp\Models\Visitors as VisitorLogs;
use GeoIP;
class DataLogVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('admin/*')) return $next($request); // Skip admin hits

        $ip = $request->ip();
        $location = geoip($ip);
        
        VisitorLogs::create([
            'ip' => $ip,
            'country' => $location->country,
            'city' => $location->city,
            'latitude' => $location->lat,
            'longitude' => $location->lon,
            'user_agent' => $request->userAgent(),
        ]);

        broadcast(new \App\Events\VisitorLogged($ip, $location));

        return $next($request);
    }
}
