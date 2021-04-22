<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPoTrackingReimbursementIdToPoTrackingReimbursementEsarupload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_reimbursement_esarupload', function (Blueprint $table) {
            $table->integer('po_tracking_reimbursement_id')->nullable();
        });
        
        Schema::table('po_tracking_reimbursement_accdocupload', function (Blueprint $table) {
            $table->integer('po_tracking_reimbursement_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_tracking_reimbursement_esarupload', function (Blueprint $table) {
            //
        });
    }
}
