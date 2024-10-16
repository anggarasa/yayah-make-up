<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Memeriksa apakah user sudah login sebagai admin
        if (Auth::guard('admin')->check()) {
            // Jika user sudah login sebagai admin, izinkan akses ke halaman admin
        } elseif (Auth::guard('web')->check()) {
            // Jika user sudah login sebagai user biasa, redirect ke halaman user-home
            return redirect()->route('user-home');
        } else {
            // Jika user belum login, redirect ke halaman '/'
            return redirect('/');
        }

        // Jika user adalah admin, lanjutkan ke halaman admin yang diminta
        return $next($request);
    }
}
