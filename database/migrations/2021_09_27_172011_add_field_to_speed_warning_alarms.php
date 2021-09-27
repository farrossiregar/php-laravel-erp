<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToSpeedWarningAlarms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('speed_warning_alarms', function (Blueprint $table) {
            $table->integer('client_project_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('sub_region_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('speed_warning_alarms', function (Blueprint $table) {
            //
        });
    }
}
