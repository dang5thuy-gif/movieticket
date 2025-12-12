<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatVe extends Model
{
    protected $table = 'dat_ve';

    protected $fillable = [
        'nguoi_dung_id',
        'suat_chieu_id',
        'tong_tien',
        'trang_thai',
        'ma_khuyen_mai_id'
    ];

    public $timestamps = false;

    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }

    public function suatChieu()
    {
        return $this->belongsTo(SuatChieu::class, 'suat_chieu_id');
    }

    // Quan hệ đúng
    public function gheDat()
    {
        return $this->hasMany(ChiTietGheDat::class, 'dat_ve_id');
    }


    public function thanhToan()
    {
        return $this->hasOne(ThanhToan::class, 'dat_ve_id');
    }

    public function maKM()
    {
        return $this->belongsTo(MaKhuyenMai::class, 'ma_khuyen_mai_id');
    }
}
