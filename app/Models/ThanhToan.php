<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThanhToan extends Model
{
    protected $table = 'thanh_toan';

    protected $fillable = [
        'dat_ve_id','nha_cung_cap','ma_giao_dich',
        'so_tien','don_vi_tien','trang_thai','hinh_thuc'
    ];

    public function datVe()
    {
        return $this->belongsTo(DatVe::class, 'dat_ve_id');
    }

    public $timestamps = false;

}
