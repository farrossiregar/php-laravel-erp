<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsStolenToCustomerAssetManagememnt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_asset_management', function (Blueprint $table) {
            $table->boolean('is_stolen')->default(0)->nullable();
            $table->boolean('is_submit')->default(0)->nullable();
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
