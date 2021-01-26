<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSiteListTrackingDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_list_tracking_temp', function (Blueprint $table) {
            $table->string('collection')->nullable();
            $table->string('no_po')->nullable();
            $table->integer('item_number')->nullable();
            $table->date('date_po_release')->nullable();
            $table->string('pic_rpm')->nullable();
            $table->string('pic_sm')->nullable();
            $table->string('type')->nullable();
            $table->string('item_description', 75)->nullable();
            $table->string('period')->nullable();
            $table->string('region')->nullable();
            $table->string('region1')->nullable();
            $table->string('project')->nullable();
            $table->string('penalty')->nullable();
            $table->string('last_status')->nullable();
            $table->string('remark')->nullable();
            $table->string('qty_po')->nullable();
            $table->string('actual_qty')->nullable();
            $table->string('no_bast')->nullable();
            $table->date('date_bast_approval')->nullable();
            $table->date('date_bast_approval_by_system')->nullable();
            $table->date('date_gr_req')->nullable();
            $table->string('no_gr')->nullable();
            $table->date('date_gr_share')->nullable();
            $table->string('no_invoice')->nullable();
            $table->date('inv_date')->nullable();
            $table->date('payment_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
