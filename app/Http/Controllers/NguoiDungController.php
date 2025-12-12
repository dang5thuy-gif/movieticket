<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatVe;

class NguoiDungController extends Controller
{
    public function profile()
    {
        $user = session('nguoi_dung');

        if (!$user || $user->vai_tro !== 'nguoi_dung') {
            return redirect()->route('login');
        }

        return view('nguoidung.profile', compact('user'));
    }

    public function history()
    {
        $user = session('nguoi_dung');

        if (!$user || $user->vai_tro !== 'nguoi_dung') {
            return redirect()->route('login');
        }

        $history = DatVe::where('nguoi_dung_id', $user->id)
            ->with(['suatChieu', 'gheDat', 'thanhToan', 'maKM'])
            ->orderBy('ngay_tao', 'desc')
            ->get();

        return view('nguoidung.history', compact('history'));
    }
}
