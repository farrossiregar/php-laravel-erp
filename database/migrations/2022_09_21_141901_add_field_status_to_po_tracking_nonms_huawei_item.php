<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldStatusToPoTrackingNonmsHuaweiItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_huawei_item', function (Blueprint $table) {
            $table->boolean('status')->default(0)->nullable();
            $table->bigInteger('invoice_amount')->default(0)->nullable();
            $table->integer('vat')->default(0)->nullable();
            $table->integer('wht')->default(0)->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('invoice_no',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_tracking_nonms_huawei_item', function (Blueprint $table) {
            //
        });
    }
}
