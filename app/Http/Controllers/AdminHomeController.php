<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        // Tự động chuyển sang trang quản lý phim
        return redirect()->route('admin.phim.index');
    }
}
