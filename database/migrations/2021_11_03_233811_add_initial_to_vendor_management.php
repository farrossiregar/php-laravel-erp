<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInitialToVendorManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_management', function (Blueprint $table) {
            $table->char('initial', 100)->nullable();
            $table->char('initial_general_information', 100)->nullable();
            $table->char('initial_team_availability_capability', 100)->nullable();
            $table->char('initial_tools_facilities', 100)->nullable();
            $table->char('initial_ehs_quality_management', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_management', function (Blueprint $table) {
            //
        });
    }
}
