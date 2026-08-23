<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PartnerMiddleware
{
    /**
     * Handle an incoming request for Partner portal.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengakses Panel Mitra Partner.');
        }

        $user = Auth::user();

        if ($user->isBanned()) {
            Auth::logout();
            $request->session()->invalidate();
            return redirect()->route('login')->with('error', 'Akun Anda telah dinonaktifkan oleh Owner.');
        }

        if (!$user->isPartner() && !$user->isOwner()) {
            return redirect()->route('home')->with('error', 'Akses ditolak! Halaman ini khusus untuk Mitra Partner terdaftar ALzis STURR.');
        }

        return $next($request);
    }
}
