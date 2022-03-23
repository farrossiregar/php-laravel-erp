<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCoordinatorIdToCustomerAssetManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_asset_management', function (Blueprint $table) {
            $table->integer('coordinator_id')->nullable();
        });
        Schema::table('critical_case_detail', function (Blueprint $table) {
            $table->integer('coordinator_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_asset_management', function (Blueprint $table) {
            //
        });
    }
}
