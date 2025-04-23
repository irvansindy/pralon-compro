<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\VisitorLogs;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Broadcast;
class LogVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        if (!VisitorLogs::where('ip', $ip)->whereDate('created_at', now())->exists()) {
            $info = Http::get("http://ip-api.com/json/{$ip}?fields=country,regionName,city")->json();
            $browser = $request->header('User-Agent');
            $device = $request->header('sec-ch-ua-platform') ?? 'Unknown';

            $log = VisitorLogs::create([
                'ip' => $ip,
                'country' => $info['country'] ?? null,
                'region' => $info['regionName'] ?? null,
                'city' => $info['city'] ?? null,
                'browser' => $browser,
                'device' => $device,
            ]);

            broadcast(new \App\Events\VisitorLogged($log))->toOthers();
        }

        return $next($request);
    }
}
