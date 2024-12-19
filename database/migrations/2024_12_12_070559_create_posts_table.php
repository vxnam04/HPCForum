<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('tieuDe');
            $table->text('noiDung');
            $table->integer('soLike')->default(0);
            $table->integer('soBinhLuan')->default(0);
            $table->timestamp('ngayDang')->nullable();
            $table->timestamps();
        });
    }
    
}
