<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnVehicleCheckToVehicleCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle_check', function (Blueprint $table) {
            $table->integer('accident_report_id')->nullable();
        });

        Schema::table('accident_report', function (Blueprint $table) {
            $table->boolean('type')->default(1)->note="1 = Personal, 2 = Vehicle";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_check', function (Blueprint $table) {
            //
        });
    }
}
