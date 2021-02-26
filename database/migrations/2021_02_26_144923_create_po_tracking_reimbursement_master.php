<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoTrackingReimbursementMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_tracking_reimbursement_master', function (Blueprint $table) {
            $table->id();
            $table->datetime('approved_bast_erp_date_upload')->nullable();
            $table->datetime('approved_esar_date_upload')->nullable();
            $table->datetime('approved_acceptance_docs_date_upload')->nullable();
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
        Schema::dropIfExists('po_tracking_reimbursement_master');
    }
}
