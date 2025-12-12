<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GheNgoi extends Model
{
    protected $table = 'ghe_ngoi';

    protected $fillable = [
        'phong_id',
        'hang_ghe',
        'cot',
        'loai_ghe',
        'nhan_ghe',
    ];

    public function phong()
    {
        return $this->belongsTo(PhongChieu::class, 'phong_id');
    }

    public function daDat()
    {
        return $this->hasMany(ChiTietGheDat::class, 'ghe_id');
    }
}
