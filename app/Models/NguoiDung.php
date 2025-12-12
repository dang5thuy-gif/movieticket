<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class NguoiDung extends Authenticatable
{
    protected $table = 'nguoi_dung';

    protected $fillable = [
        'email',
        'mat_khau',
        'ho_ten',
        'so_dien_thoai',
        'anh_dai_dien',
        'vai_tro',
        'hoat_dong',
        'google_id', 
    ];


    protected $hidden = ['mat_khau'];

    // 🔥 Quan trọng: Laravel phải biết cột dùng cho password
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    // 🔥 Dùng đúng tên timestamps từ database
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';
    public $timestamps = true;

    // 🔥 Quan hệ: User có nhiều vé đã đặt
    public function datVes()
    {
        return $this->hasMany(DatVe::class, 'nguoi_dung_id');
    }

    // 🔥 Quan hệ: User đánh giá nhiều phim
    public function danhGia()
    {
        return $this->hasMany(DanhGiaPhim::class, 'nguoi_dung_id');
    }
}
