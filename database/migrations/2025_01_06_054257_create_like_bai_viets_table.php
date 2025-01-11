<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikeBaiVietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_bai_viets', function (Blueprint $table) {
            $table->id('like_id'); // ID chính của like
            $table->foreignId('user_id') // ID người dùng
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignId('baiVietIDVietID') // Khóa ngoại liên kết với bảng bài viết
                  ->constrained('baiviet')
                  ->onDelete('cascade');
            $table->dateTime('ngay_like'); // Ngày người dùng like bài viết
            $table->boolean('trang_thai'); // Trạng thái like: true (like) hoặc false (hủy like)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('like_bai_viets');
    }
}
