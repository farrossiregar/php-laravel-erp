<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldClientProjectIdToSiteListTrackingMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_list_tracking_master', function (Blueprint $table) {
            $table->integer('client_project_id')->nullable();
        });
        Schema::table('site_list_tracking_detail', function (Blueprint $table) {
            $table->integer('client_project_id')->nullable();
        });
        Schema::table('site_list_tracking_temp', function (Blueprint $table) {
            $table->integer('client_project_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_list_tracking_master', function (Blueprint $table) {
            //
        });
    }
}
