<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\RapChieu;
use App\Models\SuatChieu;

class PhimController extends Controller
{
    public function index(Request $request)
    {
        // Lấy tab: nếu không có, mặc định là 'dang-chieu'
        $tab = $request->get('tab', 'dang-chieu');

        // Lọc phim theo tab
        if ($tab === 'dang-chieu') {
            $phims = Phim::where('ngay_cong_chieu', '<=', now())->get();
        } 
        elseif ($tab === 'sap-chieu') {
            $phims = Phim::where('ngay_cong_chieu', '>', now())->get();
        } 
        else {
            $phims = Phim::all();
        }

        return view('phim.index', compact('phims', 'tab'));
    }

    public function show(Request $request, $id)
    {
        $phim = Phim::findOrFail($id);

        // Ngày lọc
        $ngay = $request->get('ngay', now()->toDateString());

        // Thành phố lọc
        $city = $request->get('city', 'Tất cả');

        // Lấy danh sách ngày có suất chiếu
        $dsNgay = SuatChieu::where('phim_id', $id)
            ->selectRaw('DATE(gio_bat_dau) as ngay')
            ->groupBy('ngay')
            ->orderBy('ngay')
            ->get();

        // ✔ Lấy danh sách thành phố đúng theo phim
        $cities = RapChieu::select('thanh_pho')
        ->distinct()
        ->orderBy('thanh_pho')
        ->get();



        // Query suất chiếu
        $query = SuatChieu::select(
                'suat_chieu.*',
                'rap_chieu.ten_rap',
                'rap_chieu.dia_chi',
                'rap_chieu.thanh_pho',
                'phong_chieu.ten_phong'
            )
            ->join('phong_chieu', 'suat_chieu.phong_id', '=', 'phong_chieu.id')
            ->join('rap_chieu', 'phong_chieu.rap_id', '=', 'rap_chieu.id')
            ->where('suat_chieu.phim_id', $id)
            ->whereDate('suat_chieu.gio_bat_dau', $ngay);

        if ($city !== 'Tất cả') {
            $query->where('rap_chieu.thanh_pho', $city);
        }

        $suatChieuTheoRap = $query
            ->orderBy('gio_bat_dau')
            ->get()
            ->groupBy('ten_rap');

        return view('phim.show', compact('phim', 'suatChieuTheoRap', 'dsNgay', 'cities', 'ngay', 'city'));
    }


}
