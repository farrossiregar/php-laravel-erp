<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldMobileAccessToEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->boolean('app_site_list')->default(0);
            $table->boolean('app_daily_commitment')->default(0);
            $table->boolean('app_health_check')->default(0);
            $table->boolean('app_vehicle_check')->default(0);
            $table->boolean('app_ppe_check')->default(0);
            $table->boolean('app_tools_check')->default(0);
            $table->boolean('app_location_of_field_team')->default(0);
            $table->boolean('app_speed_warning')->default(0);
            $table->boolean('app_preventive_maintenance')->default(0);
            $table->boolean('app_customer_asset')->default(0);
            $table->boolean('app_work_order')->default(0);
            $table->boolean('app_drug_test')->default(0);
            $table->boolean('app_training_material')->default(0);
            $table->boolean('app_it_support')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
}
