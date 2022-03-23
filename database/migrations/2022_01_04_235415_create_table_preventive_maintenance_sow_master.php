<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePreventiveMaintenanceSowMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preventive_maintenance_sow_master', function (Blueprint $table) {
            $table->id();
            $table->integer('region_id')->nullable();
            $table->integer('sub_region_id')->nullable();
            $table->string('site_type',100)->nullable();
            $table->string('pm_type',100)->nullable();
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
        Schema::dropIfExists('preventive_maintenance_sow_master');
    }
}
