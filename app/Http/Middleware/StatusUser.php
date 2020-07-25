<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class StatusUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->status == true) {
                return $next($request);
            } else {
                notify()->warning('Akun anda belum diverifikasi atau Telah ditangguhkan, silahkan cek Email anda');
                Auth::logout();
                return back();
            }
        }
        return $next($request);
    }
}
