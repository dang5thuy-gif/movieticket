<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuatChieu extends Model
{
    protected $table = 'suat_chieu';

    protected $casts = [
        'gio_bat_dau' => 'datetime',
        'gio_ket_thuc' => 'datetime',
    ];

    public function phim()
    {
        return $this->belongsTo(Phim::class, 'phim_id');
    }

    public function phong()
    {
        return $this->belongsTo(PhongChieu::class, 'phong_id');
    }

    public $timestamps = false;
}
