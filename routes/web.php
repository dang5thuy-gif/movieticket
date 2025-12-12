<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

// Controllers người dùng
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\DatVeController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\KhuyenMaiController;

// Controllers Admin
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminPhimController;



/*
|--------------------------------------------------------------------------
| BÀI TẬP – HIỂN THỊ CÁC BỘ LAB (KHÔNG DÙNG LAYOUT)
|--------------------------------------------------------------------------
*/

// Trang chọn nhóm LAB
Route::get('/baitap', function () {
    $groups = [
        'LabTH_SV1' => '/baitap/group/LabTH_SV1',
        'LabTH_SV2' => '/baitap/group/LabTH_SV2',
    ];

    return view('baitap.groups', compact('groups'));
});

// Danh sách lab01, lab02, lab03... trong nhóm
Route::get('/baitap/group/{group}', function ($group) {

    $path = public_path($group);

    if (!is_dir($path)) {
        abort(404, "Không tìm thấy nhóm LAB: $group");
    }

    $labs = array_filter(glob($path . '/*'), 'is_dir');
    $labs = array_map('basename', $labs);

    return view('baitap.index', compact('labs', 'group'));
});

// Danh sách file trong lab
Route::get('/baitap/group/{group}/{lab}', function ($group, $lab) {

    $path = public_path("$group/$lab");

    if (!is_dir($path)) {
        abort(404, "Không tìm thấy LAB: $lab");
    }

    $files = array_map('basename', glob("$path/*"));

    return view('baitap.files', compact('group', 'lab', 'files'));
});




/*
|--------------------------------------------------------------------------
| TRANG NGƯỜI DÙNG (PUBLIC + USER ĐĂNG NHẬP)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Phim
Route::get('/phim', [PhimController::class, 'index'])->name('phim.index');
Route::get('/phim/{id}', [PhimController::class, 'show'])->name('phim.show');

// Auth User
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Khuyến mãi
Route::get('/khuyen-mai', [KhuyenMaiController::class, 'index'])->name('khuyenmai.indexkhuyenmai');
Route::get('/khuyen-mai/{id}', [KhuyenMaiController::class, 'chiTiet'])->name('khuyenmai.chitiet');


/*
|--------------------------------------------------------------------------
| NGƯỜI DÙNG ĐẶT VÉ – YÊU CẦU ĐĂNG NHẬP
|--------------------------------------------------------------------------
*/

Route::prefix('dat-ve')
    ->middleware('nguoi_dung')
    ->name('datve.')
    ->group(function () {

        Route::get('/', [DatVeController::class, 'chonPhim'])->name('chon-phim');
        Route::get('/{phimId}/chon-rap', [DatVeController::class, 'chonRap'])->name('chon-rap');
        Route::get('/{phimId}/{rapId}/chon-suat', [DatVeController::class, 'chonSuat'])->name('chon-suat');
        Route::get('/chon-ghe/{suatId}', [DatVeController::class, 'chonGhe'])->name('chon-ghe');

        // GET fallback tránh lỗi MethodNotAllowed
        Route::get('/xac-nhan', [DatVeController::class, 'xacNhanLai'])->name('xacnhan.get');
        Route::post('/xac-nhan', [DatVeController::class, 'xacNhan'])->name('xacnhan');

        Route::post('/thanh-toan', [DatVeController::class, 'thanhToan'])->name('thanh-toan');
        Route::get('/hoan-tat/{veId}', [DatVeController::class, 'hoanTat'])->name('hoantat');
    });

// User profile
Route::middleware('nguoi_dung')->group(function () {
    Route::get('/nguoi-dung/thong-tin', [NguoiDungController::class, 'profile'])->name('nguoidung.profile');
    Route::get('/nguoi-dung/lich-su', [NguoiDungController::class, 'history'])->name('nguoidung.history');
});


/*
|--------------------------------------------------------------------------
| ADMIN – LOGIN KHÔNG CẦN MIDDLEWARE
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});


/*
|--------------------------------------------------------------------------
| KHU VỰC QUẢN TRỊ – ADMIN (CÓ MIDDLEWARE)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware('admin')
    ->group(function () {

        // Khi admin login xong → chuyển về trang phim
        Route::get('/', function () {
            return redirect()->route('admin.phim.index');
        })->name('admin.home');

        // QUẢN LÝ PHIM
        Route::get('/phim', [AdminPhimController::class, 'index'])->name('admin.phim.index');
        Route::get('/phim/create', [AdminPhimController::class, 'create'])->name('admin.phim.create');
        Route::post('/phim/store', [AdminPhimController::class, 'store'])->name('admin.phim.store');
        Route::get('/phim/edit/{id}', [AdminPhimController::class, 'edit'])->name('admin.phim.edit');
        Route::post('/phim/update/{id}', [AdminPhimController::class, 'update'])->name('admin.phim.update');
        Route::delete('/phim/delete/{id}', [AdminPhimController::class, 'delete'])->name('admin.phim.delete');
    });


use App\Http\Controllers\Auth\GoogleController;

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);



