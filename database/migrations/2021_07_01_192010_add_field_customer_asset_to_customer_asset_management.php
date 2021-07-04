<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCustomerAssetToCustomerAssetManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_asset_management_history', function (Blueprint $table) {
            $table->integer('employee_id')->nullable();
            $table->integer('tower_id')->nullable();
            $table->integer('site_id')->nullable();
            $table->integer('region_cluster_id')->nullable();
            $table->string('region_name',100)->nullable();
            $table->integer('region_id')->nullable();
            $table->text('catatan')->nullable();
            $table->boolean('status')->default(0);
            $table->string('lat',255)->nullable();
            $table->string('lng',255)->nullable();
            $table->smallInteger('qty_module_1')->nullable();
            $table->string('battery_brand_1',100)->nullable();
            $table->smallInteger('battery_qty_1')->nullable();
            $table->smallInteger('qty_module_2')->nullable();
            $table->string('battery_brand_2',100)->nullable();
            $table->smallInteger('battery_qty_2')->nullable();
            $table->smallInteger('qty_module_3')->nullable();
            $table->string('battery_brand_3',100)->nullable();
            $table->smallInteger('battery_qty_3')->nullable();
            $table->text('photo_kondition')->nullable();
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
