<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldAlasanToPpeCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ppe_check', function (Blueprint $table) {
            $table->boolean('ppe_lengkap')->nullable();
            $table->text('ppe_alasan_tidak_lengkap')->nullable();
            $table->boolean('banner_lengkap')->nullable();
            $table->text('banner_alasan_tidak_lengkap')->nullable();
            $table->text('sertifikasi_alasan_tidak_lengkap')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ppe_check', function (Blueprint $table) {
            //
        });
    }
}
