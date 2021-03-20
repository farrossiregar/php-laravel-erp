<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoTrackingReimbursementAccdocupload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_tracking_reimbursement_accdocupload', function (Blueprint $table) {
            $table->id();
            $table->integer('id_po_tracking_master')->nullable();
            $table->char('po_no', 15)->nullable();
            $table->char('region', 30)->nullable();
            $table->string('accdoc_filename')->nullable();
            $table->integer('accdoc_uploader_userid')->nullable();
            $table->datetime('accdoc_date')->nullable();
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
        Schema::dropIfExists('po_tracking_reimbursement_accdocupload');
    }
}
