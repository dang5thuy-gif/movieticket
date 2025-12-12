<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'ho_ten'        => 'required|string|max:255',
            'email'         => 'required|email|unique:nguoi_dung,email',
            'so_dien_thoai' => 'required|digits_between:9,11',
            'password'      => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = NguoiDung::create([
            'ho_ten'        => $request->ho_ten,
            'email'         => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'mat_khau'      => Hash::make($request->password),
            'vai_tro'       => 'nguoi_dung',
            'hoat_dong'     => true,
        ]);

        Session::put('nguoi_dung', $user); 
        return redirect('/')->with('success', 'Đăng ký thành công! 🎉');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = NguoiDung::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->mat_khau)) {
            return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng'])->withInput();
        }

        //  THÊM KIỂM TRA QUAN TRỌNG — CHỈ CHO PHÉP VAI TRÒ NGƯỜI DÙNG
        if ($user->vai_tro !== 'nguoi_dung') {
            return back()->withErrors(['email' => 'Tài khoản này không phải tài khoản người dùng.']);
        }

        Session::put('nguoi_dung', $user);
        // 🔹 Lấy URL cần quay lại (nếu có), mặc định là trang chủ
        $redirectTo = session()->pull('url.intended', '/');
        return redirect($redirectTo)->with('success', 'Đăng nhập thành công ');

    }

    public function logout() {
        Session::forget('nguoi_dung');
        return redirect('/')->with('success', 'Đã đăng xuất!');
    }
}
