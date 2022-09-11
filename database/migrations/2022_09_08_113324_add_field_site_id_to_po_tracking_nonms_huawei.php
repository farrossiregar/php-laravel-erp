<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldSiteIdToPoTrackingNonmsHuawei extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_huawei_item', function (Blueprint $table) {
            // $table->string('project_code',50)->nullable();
            $table->string('site_id',40)->nullable();
            $table->string('sub_contract',10)->nullable();
            // $table->string('pr_no',50)->nullable();
            $table->string('po_line_no',10)->nullable();
            $table->string('shipment_no',10)->nullable();
            $table->string('version_no',10)->nullable();
            $table->string('project_name',200)->nullable();
            $table->string('site_code',100)->nullable();
            $table->integer('request_qty')->nullable();
            $table->integer('due_qty')->nullable();
            $table->integer('billed_qty')->nullable();
            $table->integer('qty_cancel')->nullable();
            $table->string('unit',100)->nullable();
            $table->integer('unit_price')->nullable();
            $table->integer('line_amount')->nullable();
            $table->string('center_area',100)->nullable();
            $table->string('bidding_area',100)->nullable();
            $table->date('publish_date')->nullable();
            $table->date('acceptance_date')->nullable();
            $table->text('note_to_receiver')->nullable();
            $table->string('pds_category',15)->nullable();
            $table->string('pds_amount',150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_tracking_nonms_huawei', function (Blueprint $table) {
            //
        });
    }
}
