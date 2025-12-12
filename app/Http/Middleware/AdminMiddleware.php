<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $admin = session('admin');

        if (!$admin) {
            return redirect('/admin/login')->with('error', 'Bạn chưa đăng nhập admin!');
        }

        // Kiểm tra vai trò
        if (isset($admin->vai_tro) && $admin->vai_tro !== 'admin') {
            return redirect('/admin/login')->with('error', 'Bạn không có quyền truy cập!');
        }

        return $next($request);
    }
}
