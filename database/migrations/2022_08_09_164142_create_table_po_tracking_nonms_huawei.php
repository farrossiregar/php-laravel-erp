<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePoTrackingNonmsHuawei extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_tracking_nonms_huawei', function (Blueprint $table) {
            $table->id();
            $table->integer('region_id')->nullable();
            $table->string('wo_number',255)->nullable();
            $table->string('site_id',100)->nullable();
            $table->string('site_name',200)->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->integer('employee_id')->nullable();
            $table->timestamps();
        });

        Schema::create('po_tracking_nonms_huawei_item', function (Blueprint $table) {
            $table->id();
            $table->integer('po_tracking_nonms_huawei_id')->nullable();
            $table->string('item_code',100)->nullable();
            $table->string('item_decription',200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('po_tracking_nonms_huawei');
    }
}
