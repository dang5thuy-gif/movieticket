<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    // Chuyển hướng sang Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Xử lý callback từ Google
    public function callback()
    {
        try {
            // LẤY THÔNG TIN USER TỪ GOOGLE
            $googleUser = Socialite::driver('google')->user();

            // Kiểm tra user theo google_id
            $user = NguoiDung::where('google_id', $googleUser->id)->first();

            if (!$user) {
                // Nếu chưa có → kiểm tra email
                $user = NguoiDung::where('email', $googleUser->email)->first();

                if (!$user) {
                    // TẠO USER MỚI
                    $user = NguoiDung::create([
                        'google_id'    => $googleUser->id,
                        'email'        => $googleUser->email,
                        'ho_ten'       => $googleUser->name,
                        'anh_dai_dien' => $googleUser->avatar,
                        'mat_khau'     => bcrypt(Str::random(12)), // password random
                        'vai_tro'      => 'nguoi_dung',
                        'hoat_dong'    => true,
                    ]);
                } else {
                    // Nếu đã có theo email → cập nhật google_id
                    $user->update([
                        'google_id' => $googleUser->id
                    ]);
                }
            }

            // ĐĂNG NHẬP THEO AUTH LARAVEL
            Auth::login($user);

            // ĐẶC BIỆT QUAN TRỌNG: GÁN LẠI SESSION CHO HỆ THỐNG CŨ CỦA BẠN
            session(['nguoi_dung' => $user]);

            // Chuyển hướng về trang chủ
            return redirect('/')
                ->with('success', 'Đăng nhập Google thành công!');

        } catch (\Exception $e) {

            return redirect('/login')
                ->with('error', 'Đăng nhập Google thất bại: ' . $e->getMessage());
        }
    }
}
