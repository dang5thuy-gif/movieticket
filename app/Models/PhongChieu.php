<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhongChieu extends Model
{
    protected $table = 'phong_chieu';

    public function rap()
    {
        return $this->belongsTo(RapChieu::class, 'rap_id');
    }

    public function suatChieu()
    {
        return $this->hasMany(SuatChieu::class, 'phong_id');
    }

    public $timestamps = false;

}
