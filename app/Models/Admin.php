<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'nguoi_dung';

    protected $fillable = [
        'ho_ten',
        'email',
        'mat_khau',
        'vai_tro',
        'hoat_dong',
    ];

    protected $hidden = ['mat_khau'];

    public $timestamps = false;
    // Thêm phương thức để Laravel biết cách lấy mật khẩu
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }
}
