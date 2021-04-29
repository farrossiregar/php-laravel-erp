<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VehicleCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_check', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->string('plat_nomor',25)->nullable();
            $table->text('foto_mobil_plat_nomor')->nullable();
            $table->boolean('stiker_safety_driving')->default(0)->nullable();
            $table->text('foto_stiker_safety_driving')->nullable();
            $table->text('vehicle_cleanliness')->nullable();
            $table->text('accident_report')->nullable();
            $table->timestamps();
        });

        Schema::create('ppe_check', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->text('foto_dengan_ppe')->nullable();
            $table->text('foto_banner')->nullable();
            $table->text('foto_wah')->nullable();
            $table->text('foto_elektrikal')->nullable();
            $table->text('foto_first_aid')->nullable();
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
        Schema::dropIfExists('vehicle_check');
    }
}
