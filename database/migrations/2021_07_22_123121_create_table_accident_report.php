<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAccidentReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accident_report', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->string('site_id',255)->nullable();
            $table->date('date')->nullable();
            $table->string('klasifikasi_insiden',100)->nullable();
            $table->string('jenis_insiden',100)->nullable();
            $table->text('rincian_kronologis')->nullable();
            $table->string('nik_and_nama',200)->nullable();
            $table->timestamps();
        });

        Schema::create('accident_report_image', function (Blueprint $table) {
            $table->id();
            $table->integer('accident_report_id')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('accident_report');
    }
}
