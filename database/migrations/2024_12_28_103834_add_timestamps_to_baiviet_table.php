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
    Schema::table('baiviet', function (Blueprint $table) {
        $table->timestamps(); // Thêm created_at và updated_at
    });
}

public function down()
{
    Schema::table('baiviet', function (Blueprint $table) {
        $table->dropTimestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */

};
