<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user belum login ATAU role-nya bukan super_admin, tendang ke halaman utama!
        if (!auth()->check() || auth()->user()->role !== 'super_admin') {
            abort(403, 'Akses Ditolak: Anda tidak memiliki izin otorisasi ke portal ini.');
        }

        return $next($request);
    }
}