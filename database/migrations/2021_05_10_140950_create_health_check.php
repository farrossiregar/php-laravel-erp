<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_check', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->string('company',100)->nullable();
            $table->string('lokasi_kantor',200)->nullable();
            $table->string('department',200)->nullable();
            $table->string('status_bekerja',100)->nullable();
            $table->boolean('kondisi_badan')->nullable();
            $table->boolean('tinggal_serumah_covid')->nullable();
            $table->boolean('bepergian_keluar_kota')->nullable();
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
        Schema::dropIfExists('health_check');
    }
}
