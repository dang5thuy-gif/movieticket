<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phim extends Model
{
    protected $table = 'phim';

    public $timestamps = false;

    protected $fillable = [
        'ten_phim',
        'mo_ta',
        'noi_dung_phim',
        'thoi_luong',
        'danh_gia',
        'ngon_ngu',
        'the_loai',          
        'ngay_cong_chieu',
        'anh_bia',
        'trailer'
    ];

    protected $casts = [
        'ngay_cong_chieu' => 'date',
        'ngay_tao' => 'datetime',
    ];


    public function suatChieu()
    {
        return $this->hasMany(SuatChieu::class, 'phim_id');
    }

    public function danhGia()
    {
        return $this->hasMany(DanhGiaPhim::class, 'phim_id');
    }
}
