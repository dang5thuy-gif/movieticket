<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatVe;
use App\Models\ThanhToan;

class ThanhToanController extends Controller
{
    // Trang chọn phương thức thanh toán
    public function chonPhuongThuc($id)
    {
        $datVe = DatVe::findOrFail($id);
        return view('datve.chon_phuong_thuc', compact('datVe'));
    }

    // Xử lý sau khi chọn phương thức thanh toán
    public function xuLyThanhToan(Request $request, $id)
    {
        $request->validate([
            'hinh_thuc' => 'required|string'
        ]);

        $datVe = DatVe::findOrFail($id);

        // Tạo bản ghi giao dịch trong bảng thanh_toan
        $thanhToan = ThanhToan::create([
            'dat_ve_id'   => $datVe->id,
            'nha_cung_cap'=> strtoupper($request->hinh_thuc),
            'ma_giao_dich'=> null,
            'so_tien'     => $datVe->tong_tien,
            'hinh_thuc'   => $request->hinh_thuc,
            'trang_thai'  => 'dang_xu_ly',
        ]);

        // Điều hướng đúng theo phương thức
        switch ($request->hinh_thuc) {

            case 'momo':
                return redirect()->route('thanh_toan.momo', $thanhToan->id);

            case 'vnpay':
                return redirect()->route('thanh_toan.vnpay', $thanhToan->id);

            case 'zalopay':
                return redirect()->route('thanh_toan.zalopay', $thanhToan->id);

            default:
                return back()->withErrors(['hinh_thuc' => 'Phương thức không hợp lệ']);
        }
    }
}
