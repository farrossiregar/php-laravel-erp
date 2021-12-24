<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToVehicleSyncron extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle_syncron', function (Blueprint $table) {
            $table->string('no_polis',20)->nullable();
            $table->string('vendor',50)->nullable();
            $table->string('brand',20)->nullable();
            $table->string('type',20)->nullable();
            $table->string('merk',20)->nullable();
            $table->string('tahun',10)->nullable();
            $table->string('stnk_no',30)->nullable();
            $table->date('end_date_pajak')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('cluster_id')->nullable();
            $table->integer('sub_cluster_id')->nullable();
            $table->integer('driver_employee_id')->nullable();
            $table->boolean('type_sim')->nullable();
            $table->boolean('car_motorcycle')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_syncron', function (Blueprint $table) {
            //
        });
    }
}
