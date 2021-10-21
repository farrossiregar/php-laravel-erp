<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToPreventiveMaintenance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preventive_maintenance', function (Blueprint $table) {
            $table->string('site_id',105)->change();
            $table->string('site_name',255)->nullable();
            $table->string('site_category',50)->nullable();
            $table->string('site_type',50)->nullable();
            $table->string('pm_type',10)->nullable();
            $table->integer('sub_region_id')->nullable();
            $table->string('cluster',200)->nullable();
            $table->string('sub_cluster',200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preventive_maintenance', function (Blueprint $table) {
            //
        });
    }
}
