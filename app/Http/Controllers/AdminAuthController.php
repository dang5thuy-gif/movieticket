<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function showLogin() {
        return view('admin.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->mat_khau)) {
            return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng']);
        }

        if ($admin->vai_tro !== 'admin') {
            return back()->withErrors(['email' => 'Bạn không có quyền truy cập quản trị.']);
        }

        Session::forget('admin');
        Session::put('admin', $admin);

        // 🔥 CHUYỂN THẲNG VỀ TRANG QUẢN LÝ PHIM (KHÔNG GỌI DASHBOARD NỮA)
        return redirect()->route('admin.phim.index')
            ->with('success', 'Đăng nhập thành công!');
    }



    public function logout() {
        Session::forget('admin');
        return redirect()->route('admin.login')->with('success', 'Đã đăng xuất!');
    }
}
