<?php

use Illuminate\Database\Seeder;
use App\Models\GheNgoi;

class GheSeeder extends Seeder
{
    public function run()
    {
        $phongId = 1; // phòng nào bạn muốn tạo ghế

        // Ghế thường: A → F (6 hàng)
        foreach (range('A', 'F') as $hang) {
            for ($cot = 1; $cot <= 10; $cot++) {
                GheNgoi::create([
                    'phong_id' => $phongId,
                    'hang_ghe' => $hang,
                    'cot' => $cot,
                    'loai_ghe' => 'thuong',
                    'nhan_ghe' => $hang . $cot
                ]);
            }
        }

        // Ghế VIP: G → I (3 hàng)
        foreach (range('G', 'I') as $hang) {
            for ($cot = 1; $cot <= 10; $cot++) {
                GheNgoi::create([
                    'phong_id' => $phongId,
                    'hang_ghe' => $hang,
                    'cot' => $cot,
                    'loai_ghe' => 'vip',
                    'nhan_ghe' => $hang . $cot
                ]);
            }
        }

        // Ghế đôi: J → K (2 hàng), mỗi ghế đôi chiếm 2 ghế
        foreach (['J', 'K'] as $hang) {
            for ($cot = 1; $cot <= 10; $cot += 2) {
                GheNgoi::create([
                    'phong_id' => $phongId,
                    'hang_ghe' => $hang,
                    'cot' => $cot,
                    'loai_ghe' => 'doi',
                    'nhan_ghe' => $hang . $cot . '-' . $hang . ($cot + 1)
                ]);
            }
        }
    }
}
