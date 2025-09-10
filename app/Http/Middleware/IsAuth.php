<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // // Pastikan pengguna sudah login dan merupakan admin
        // if (Auth::check() ) {
        //     return $next($request);
        // }

        // // Jika tidak, arahkan kembali atau tampilkan halaman error
        // return redirect()->route('auth.login')->with('error', 'Akses ditolak.');
        return $next($request);
    }
}
