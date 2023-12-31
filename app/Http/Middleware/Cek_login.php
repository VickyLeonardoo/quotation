<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cek_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!auth::check()) {
            return redirect('login')->with('error, Kamu Belum Login!');
        }
        $user = Auth::user();
        if ($user->is_active == 1) {
            if (in_array($user->role, $roles)) {
                return $next($request);
            }
        }else{
            return redirect('login')->with('error','Akun tidak Active');
        }
        return redirect('login')->with('error','Kamu Tidak Punya Akses');
    }
}
