<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietGheDat extends Model
{
    protected $table = 'chi_tiet_ghe_dat';

    protected $fillable = [
        'dat_ve_id','ghe_id','gia_ve','nhan_ghe'
    ];

    public function datVe()
    {
        return $this->belongsTo(DatVe::class, 'dat_ve_id');
    }

    public function ghe()
    {
        return $this->belongsTo(GheNgoi::class, 'ghe_id');
    }

    public $timestamps = false;

}
