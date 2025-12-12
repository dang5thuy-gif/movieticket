<?php

namespace App\Http\Controllers;

use App\Models\MaKhuyenMai;

class KhuyenMaiController extends Controller
{
    // Danh sách khuyến mãi
    public function index()
    {
        $ds = MaKhuyenMai::orderBy('ngay_ket_thuc')->get();
        return view('khuyenmai.indexkhuyenmai', compact('ds'));
    }

    // Chi tiết khuyến mãi
    public function chiTiet($id)
    {
        $km = MaKhuyenMai::findOrFail($id);
        return view('khuyenmai.chitiet', compact('km'));
    }
}
