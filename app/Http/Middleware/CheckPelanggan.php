<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPelanggan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Cek apakah pelanggan sudah login (misalnya berdasarkan session)
        $pelangganId = session('pelanggan_id');

        if (!$pelangganId) {
            return redirect()->route('login'); // Redirect jika tidak ada ID
        }

        // Menyimpan ID pelanggan ke dalam request
        $request->attributes->set('pelanggan_id', $pelangganId);

        return $next($request);
    }
}
