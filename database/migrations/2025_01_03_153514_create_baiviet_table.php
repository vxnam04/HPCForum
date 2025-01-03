<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baiviet', function (Blueprint $table) {
            $table->string('baiVietID')->primary(); // Mã bài viết
            $table->string('tieuDe'); // Tiêu đề bài viết
            $table->text('noiDung'); // Nội dung bài viết
            $table->date('ngayDang'); // Ngày đăng bài viết
            $table->integer('soLike')->default(0); // Số lượng "like" bài viết
            $table->integer('soBinhLuan')->default(0); // Số lượng bình luận
            $table->boolean('trangThaiDuyet')->default(false); // Trạng thái duyệt
            $table->string('userID');
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
        Schema::dropIfExists('baiviet');
    }
};
