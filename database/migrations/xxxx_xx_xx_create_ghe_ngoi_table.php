<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ghe_ngoi', function (Blueprint $table) {
            $table->id();

            // Phòng chiếu (mỗi phòng có sơ đồ riêng)
            $table->unsignedBigInteger('phong_id');

            // Vị trí ghế
            $table->string('hang_ghe', 10);   // A, B, C...
            $table->integer('cot');           // 1,2,3...
            $table->string('nhan_ghe', 20);   // A1, A2...

            // Loại ghế
            $table->enum('loai_ghe', ['thuong', 'vip', 'doi'])
                  ->default('thuong');

            $table->timestamps();

            // Chống trùng ghế
            $table->unique(['phong_id', 'nhan_ghe']);

            // Khóa ngoại
            $table->foreign('phong_id')
                ->references('id')
                ->on('phong_chieu')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ghe_ngoi');
    }
};
