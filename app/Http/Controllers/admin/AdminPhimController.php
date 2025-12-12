<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phim;
use Illuminate\Http\Request;

class AdminPhimController extends Controller
{
    /** DANH SÁCH PHIM */
    public function index()
    {
        $phims = Phim::latest('id')->get();
        return view('admin.phim.index', compact('phims'));
    }

    /** FORM THÊM PHIM */
    public function create()
    {
        return view('admin.phim.create');
    }

    /** LƯU PHIM MỚI */
    public function store(Request $request)
    {
        $request->validate([
            'ten_phim' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'noi_dung_phim' => 'nullable|string',
            'thoi_luong' => 'required|integer',
            'danh_gia' => 'nullable|string|max:10',
            'ngon_ngu' => 'required|string|max:50',
            'the_loai' => 'nullable|string|max:255',
            'ngay_cong_chieu' => 'required|date',
            'anh_bia' => 'required|image',
            'trailer' => 'nullable|string|max:500',
        ]);

        // Upload ảnh
        $fileName = time() . '_' . $request->anh_bia->getClientOriginalName();
        $request->anh_bia->move(public_path('images'), $fileName);

        Phim::create([
            'ten_phim'        => $request->ten_phim,
            'mo_ta'           => $request->mo_ta,
            'noi_dung_phim'   => $request->noi_dung_phim,
            'thoi_luong'      => $request->thoi_luong,
            'danh_gia'        => $request->danh_gia,
            'ngon_ngu'        => $request->ngon_ngu,
            'the_loai'        => $request->the_loai,
            'ngay_cong_chieu' => $request->ngay_cong_chieu,
            'anh_bia'         => $fileName,
            'trailer'         => $request->trailer,
        ]);

        return redirect()->route('admin.phim.index')
                         ->with('success', 'Thêm phim thành công!');
    }

    /** FORM SỬA */
    public function edit($id)
    {
        $phim = Phim::findOrFail($id);
        return view('admin.phim.edit', compact('phim'));
    }

    /** CẬP NHẬT PHIM */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_phim' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'noi_dung_phim' => 'nullable|string',
            'thoi_luong' => 'required|integer',
            'danh_gia' => 'nullable|string|max:10',
            'ngon_ngu' => 'nullable|string|max:50',
            'the_loai' => 'nullable|string|max:255',
            'ngay_cong_chieu' => 'required|date',
            'anh_bia' => 'nullable|image',
            'trailer' => 'nullable|string|max:500',
        ]);

        $phim = Phim::findOrFail($id);

        // Upload ảnh mới nếu có
        if ($request->hasFile('anh_bia')) {
            $file = $request->file('anh_bia');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $phim->anh_bia = $fileName;
        }

        $phim->update([
            'ten_phim'        => $request->ten_phim,
            'mo_ta'           => $request->mo_ta,
            'noi_dung_phim'   => $request->noi_dung_phim,
            'thoi_luong'      => $request->thoi_luong,
            'danh_gia'        => $request->danh_gia,
            'ngon_ngu'        => $request->ngon_ngu,
            'the_loai'        => $request->the_loai,
            'ngay_cong_chieu' => $request->ngay_cong_chieu,
            'trailer'         => $request->trailer,
            'anh_bia'         => $phim->anh_bia,
        ]);

        return redirect()->route('admin.phim.index')
                         ->with('success', 'Cập nhật phim thành công!');
    }

    /** XÓA */
    public function delete($id)
    {
        $phim = Phim::findOrFail($id);
        $phim->delete();

        return redirect()->route('admin.phim.index')
                         ->with('success', 'Xóa phim thành công!');
    }
}
