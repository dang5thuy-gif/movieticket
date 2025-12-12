<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RapChieu extends Model
{
    protected $table = 'rap_chieu';

    protected $fillable = ['ten_rap','dia_chi','thanh_pho','so_dien_thoai'];

    public function phong()
    {
        return $this->hasMany(PhongChieu::class, 'rap_id');
    }

    public $timestamps = false;

}
