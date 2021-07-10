<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDescriptionToHealthCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('health_check', function (Blueprint $table) {
            $table->string('status_bekerja_others',255)->nullable();
            $table->string('kondisi_badan_sakit',255)->nullable();
            $table->string('bepergian_keluar_kota_ya',255)->nullable();
            $table->string('tinggal_serumah_covid_ya',255)->nullable();
            $table->string('mengunjungi_keluarga_ya',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_check', function (Blueprint $table) {
            //
        });
    }
}
