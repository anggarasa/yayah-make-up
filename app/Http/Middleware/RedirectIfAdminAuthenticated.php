<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAdminAuthenticated
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
            // Jika admin sudah login, redirect ke dashboard admin
            return redirect('/admin/dashboard');
        }
    
        // Jika belum login, lanjutkan request ke halaman yang diminta
        return $next($request);
    }
}