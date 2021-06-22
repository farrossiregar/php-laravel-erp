<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldDateApprovedToSiteListTrackingMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_list_tracking_master', function (Blueprint $table) {
            $table->date('approved_date')->nullable();
            $table->integer('approved_id')->nullable();
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
