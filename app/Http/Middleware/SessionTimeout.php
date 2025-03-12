<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika pengguna belum login, lanjutkan saja
        if (!Auth::check()) {
            return $next($request);
        }

        $lastActivity = session('last_activity');
        $timeout = 2 * 60 * 60; // 2 jam dalam detik

        if ($lastActivity && (time() - $lastActivity > $timeout)) {
            Auth::logout();
            session()->flush();
            return redirect('/login')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        // Perbarui waktu aktivitas terakhir
        session(['last_activity' => time()]);

        return $next($request);
    }
}
