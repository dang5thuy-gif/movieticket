<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\SuatChieu;
use App\Models\PhongChieu;
use App\Models\RapChieu;
use App\Models\GheNgoi;
use App\Models\DatVe;
use App\Models\ChiTietGheDat;
use App\Models\ThanhToan;
use App\Models\MaKhuyenMai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DatVeController extends Controller
{
    /* -------------------------------
        CHỌN PHIM
    -------------------------------- */
    public function chonPhim(Request $request)
    {
        $phim = Phim::orderBy('ngay_cong_chieu', 'desc')->get();
        $maKm = $request->query('ma_km');

        return view('datve.chonphim', compact('phim', 'maKm'));
    }

    /* -------------------------------
        CHỌN RẠP
    -------------------------------- */
    public function chonRap($phimId, Request $request)
    {
        $phim = Phim::findOrFail($phimId);

        $raps = RapChieu::whereHas('phong.suatChieu', function ($q) use ($phimId) {
            $q->where('phim_id', $phimId);
        })->get();

        $maKm = $request->query('ma_km');

        return view('datve.chonrap', compact('phim', 'raps', 'maKm'));
    }

    /* -------------------------------
        CHỌN SUẤT CHIẾU
    -------------------------------- */
    public function chonSuat($phimId, $rapId, Request $request)
    {
        $phim = Phim::findOrFail($phimId);
        $rap  = RapChieu::findOrFail($rapId);

        $suatChieu = SuatChieu::with('phong')
            ->where('phim_id', $phimId)
            ->whereHas('phong', fn($q) => $q->where('rap_id', $rapId))
            ->orderBy('gio_bat_dau')
            ->get();

        $maKm = $request->query('ma_km');

        return view('datve.chonsuatchieu', compact('phim', 'rap', 'suatChieu', 'maKm'));
    }

    /* -------------------------------
        CHỌN GHẾ
    -------------------------------- */
    public function chonGhe($suatId, Request $request)
    {
        $suat = SuatChieu::with('phim')->findOrFail($suatId);
        $ghe  = GheNgoi::where('phong_id', $suat->phong_id)->get();

        $gheDaDat = ChiTietGheDat::whereHas('datVe', fn($q) =>
            $q->where('suat_chieu_id', $suatId)
        )->pluck('ghe_id')->toArray();

        $maKm = $request->query('ma_km');

        return view('datve.chonghe', [
            'suat'        => $suat,
            'gheTheohang' => $ghe->groupBy('hang_ghe'),
            'gheDaDat'    => $gheDaDat,
            'maKm'        => $maKm,
        ]);
    }

    /* ======================================================
        HÀM KIỂM TRA MÃ KHUYẾN MÃI
    ======================================================= */
    private function kiemTraMaKM($maNhap)
    {
        if (!$maNhap) return null;

        return MaKhuyenMai::where('ma', $maNhap)
            ->where('hoat_dong', true)
            ->whereDate('ngay_bat_dau', '<=', now())
            ->whereDate('ngay_ket_thuc', '>', now())  // CHỈNH Ở ĐÂY
            ->first();
    }


    /* -------------------------------
        XÁC NHẬN
    -------------------------------- */
    public function xacNhan(Request $request)
    {
        $request->validate([
            'suat_chieu_id' => 'required',
            'ghe'           => 'required|array|min:1',
        ]);

        $suat = SuatChieu::with('phim')->findOrFail($request->suat_chieu_id);

        $soGhe = count($request->ghe);
        $giaVe = 90000;
        $tongTienGoc = $soGhe * $giaVe;

        $maNhap = $request->input('ma_khuyen_mai') ?? $request->input('ma_km');
        $maKM   = $this->kiemTraMaKM($maNhap);

        $giamGia = 0;
        $kmError = null;

        if ($maNhap && !$maKM) {
            $kmError = " Mã không hợp lệ hoặc đã hết hạn!";
        } elseif ($maKM) {
            $giamGia = round($tongTienGoc * $maKM->phan_tram_giam / 100);
        }

        return view('datve.xacnhan', [
            'suat'            => $suat,
            'ghe'             => $request->ghe,
            'tongTienGoc'     => $tongTienGoc,
            'tongTienSauGiam' => $tongTienGoc - $giamGia,
            'giamGia'         => $giamGia,
            'maKM'            => $maKM,
            'maNhap'          => $maNhap,
            'kmError'         => $kmError
        ]);
    }

    /* -------------------------------
        THANH TOÁN
    -------------------------------- */
    public function thanhToan(Request $request)
    {
        $request->validate([
            'suat_chieu_id'  => 'required',
            'ghe'            => 'required|array',
            'ma_khuyen_mai'  => 'nullable|string',
        ]);

        $soGhe = count($request->ghe);
        $giaVe = 90000;
        $tongTienGoc = $soGhe * $giaVe;

        $maNhap = $request->ma_khuyen_mai;
        $maKM   = $this->kiemTraMaKM($maNhap);

        if ($maNhap && !$maKM) {
            return back()->with('km_error', ' Mã khuyến mãi không hợp lệ hoặc đã hết hạn!');
        }

        $giamGia = $maKM ? round($tongTienGoc * $maKM->phan_tram_giam / 100) : 0;

        $tongTienThanhToan = $tongTienGoc - $giamGia;

        $user = Session::get('nguoi_dung');

        $datVe = DatVe::create([
            'nguoi_dung_id'    => $user->id,
            'suat_chieu_id'    => $request->suat_chieu_id,
            'tong_tien'        => $tongTienThanhToan,
            'trang_thai'       => 'da_xac_nhan',
            'ma_khuyen_mai_id' => $maKM?->id,
        ]);

        foreach ($request->ghe as $gheId) {
            ChiTietGheDat::create([
                'dat_ve_id' => $datVe->id,
                'ghe_id'    => $gheId,
                'gia_ve'    => $giaVe,
            ]);
        }

        ThanhToan::create([
            'dat_ve_id'    => $datVe->id,
            'nha_cung_cap' => 'MOMO',
            'so_tien'      => $tongTienThanhToan,
            'trang_thai'   => 'thanh_cong',
        ]);

        return redirect()->route('datve.hoantat', $datVe->id);
    }

    /* -------------------------------
        HOÀN TẤT
    -------------------------------- */
    public function hoanTat($veId)
    {
        $datVe = DatVe::with([
            'suatChieu.phim',
            'suatChieu.phong.rap',
            'gheDat.ghe',
            'thanhToan',
            'maKM'
        ])->findOrFail($veId);

        return view('datve.hoantat', compact('datVe'));
    }

    /* -------------------------------
        XÁC NHẬN LẠI
    -------------------------------- */
    public function xacNhanLai(Request $request)
    {
        if (!$request->has('suat_chieu_id') || !$request->has('ghe')) {
            return redirect()->route('datve.chon-phim')
                ->with('error', 'Thiếu thông tin suất chiếu hoặc ghế.');
        }

        $suat = SuatChieu::with('phim')->findOrFail($request->suat_chieu_id);

        $soGhe = count($request->ghe);
        $giaVe = 90000;

        return view('datve.xacnhan', [
            'suat' => $suat,
            'ghe'  => $request->ghe,
            'tongTienGoc' => $soGhe * $giaVe,
            'tongTienSauGiam' => $soGhe * $giaVe,
            'giamGia' => 0,
            'maKM' => null,
            'maNhap' => null
        ]);
    }
}
