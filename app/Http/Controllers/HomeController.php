<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 4 phim đang chiếu ngẫu nhiên
        $phimDangChieu = DB::table('phim')
            ->where('ngay_cong_chieu', '<=', now()) // ngày khởi chiếu <= hiện tại
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // Lấy 4 phim sắp chiếu ngẫu nhiên
        $phimSapChieu = DB::table('phim')
            ->where('ngay_cong_chieu', '>', now()) // ngày khởi chiếu > hiện tại
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('home', compact('phimDangChieu', 'phimSapChieu'));
    }
}

