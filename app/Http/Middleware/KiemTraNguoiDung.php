<?php

namespace App\Http\Middleware;

use Closure;

class KiemTraNguoiDung
{
    public function handle($request, Closure $next)
    {
        // ✔ Bypass middleware cho /baitap
        if ($request->is('baitap*')) {
            return $next($request);
        }

        $user = session('nguoi_dung');

        if (!$user || $user->vai_tro !== 'nguoi_dung') {

            if ($request->method() === 'GET') {
                $request->session()->put('url.intended', $request->fullUrl());
            }

            return redirect()
                ->route('login')
                ->with('warning', '⚠ Bạn cần đăng nhập tài khoản người dùng để tiếp tục đặt vé!');
        }

        return $next($request);
    }
}
