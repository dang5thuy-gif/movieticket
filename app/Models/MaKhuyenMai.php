<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaKhuyenMai extends Model
{
    protected $table = 'ma_khuyen_mai';

    protected $fillable = [
        'ma',
        'phan_tram_giam',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'hoat_dong',
    ];

    public $timestamps = false;

    // Kiểm tra còn hạn
    public function conHan()
    {
        return $this->hoat_dong &&
            now()->toDateString() >= $this->ngay_bat_dau &&
            now()->toDateString() <  $this->ngay_ket_thuc; // ĐÃ SỬA
    }

}
