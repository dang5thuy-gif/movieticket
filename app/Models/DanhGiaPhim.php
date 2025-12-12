<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGiaPhim extends Model
{
    protected $table = 'danh_gia_phim';

    protected $fillable = [
        'phim_id',
        'nguoi_dung_id',
        'so_sao',
        'binh_luan'
    ];

    public function phim()
    {
        return $this->belongsTo(Phim::class, 'phim_id');
    }

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }
}
