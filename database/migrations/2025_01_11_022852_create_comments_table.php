<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();  // Khóa chính tự tăng
            $table->unsignedBigInteger('bai_viet_id');  // Khóa ngoại liên kết với bảng posts
            $table->unsignedBigInteger('user_id');  // Khóa ngoại liên kết với bảng users
            $table->text('noi_dung');  // Nội dung bình luận
            $table->timestamps();  // Thời gian tạo và cập nhật

            // Định nghĩa các khóa ngoại
            $table->foreign('bai_viet_id')->references('baiVietID')->on('baiviet')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
