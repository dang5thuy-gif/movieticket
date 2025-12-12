<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GhePhongSeeder extends Seeder
{
    public function run(): void
    {
        $this->taoSoDoStandard(1);
        $this->taoSoDoVIP(2);
        $this->taoSoDoCGV(3);
    }

    // ===============================
    // 🔵 1. SƠ ĐỒ PHÒNG CHUẨN
    // ===============================
    private function taoSoDoStandard($phongId)
    {
        $hangs = ['A','B','C','D','E','F','G','H'];

        foreach ($hangs as $hang) {
            for ($cot = 1; $cot <= 12; $cot++) {

                $loai = 'thuong';

                DB::table('ghe_ngoi')->updateOrInsert(
                    [
                        'phong_id' => $phongId,
                        'hang_ghe' => $hang,
                        'cot'      => $cot
                    ],
                    [
                        'nhan_ghe'   => $hang . $cot,
                        'loai_ghe'   => $loai,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }
        }
    }

    // ===============================
    // 🔶 2. SƠ ĐỒ PHÒNG VIP
    // ===============================
    private function taoSoDoVIP($phongId)
    {
        $hangs = ['A','B','C','D','E','F','G','H','I','J'];

        foreach ($hangs as $hang) {
            for ($cot = 1; $cot <= 16; $cot++) {

                $loai = 'thuong';
                if ($cot >= 5 && $cot <= 12) {
                    $loai = 'vip';
                }

                DB::table('ghe_ngoi')->updateOrInsert(
                    [
                        'phong_id' => $phongId,
                        'hang_ghe' => $hang,
                        'cot'      => $cot
                    ],
                    [
                        'nhan_ghe'   => $hang . $cot,
                        'loai_ghe'   => $loai,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }
        }
    }

    // ===============================
    // ❤️‍🔥 3. CGV STYLE — GHẾ ĐÔI
    // ===============================
    private function taoSoDoCGV($phongId)
    {
        $hangs = ['A','B','C','D','E','F','G','H','I','J'];

        foreach ($hangs as $hang) {
            for ($cot = 1; $cot <= 18; $cot++) {

                $loai = 'thuong';

                if ($cot >= 7 && $cot <= 12) {
                    $loai = 'vip';
                }

                if (in_array($hang, ['I','J']) && $cot >= 17) {
                    $loai = 'doi';
                }

                DB::table('ghe_ngoi')->updateOrInsert(
                    [
                        'phong_id' => $phongId,
                        'hang_ghe' => $hang,
                        'cot'      => $cot
                    ],
                    [
                        'nhan_ghe'   => $hang . $cot,
                        'loai_ghe'   => $loai,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }
        }
    }
}
