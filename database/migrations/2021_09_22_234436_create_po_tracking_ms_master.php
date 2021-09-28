<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoTrackingMsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_tracking_ms_master', function (Blueprint $table) {
            $table->id();
            $table->char('status', 10)->nullable();
            $table->string('note', 250)->nullable();
            // $table->char('pds', 30)->nullable();
            // $table->char('approval_docs', 30)->nullable();
            // $table->char('approved_verification', 30)->nullable();
            // $table->char('acceptance_docs', 30)->nullable();
            // $table->char('invoice', 30)->nullable();
            $table->timestamps();
        });

        // Schema::create('po_tracking_ms_detail', function (Blueprint $table) {
        //     $table->id();
        //     $table->char('id_po_master', 10)->nullable();
        //     $table->char('id_po', 20)->nullable();
        //     $table->char('po_no', 20)->nullable();
        //     $table->char('po_line_ship', 20)->nullable();
        //     $table->char('year', 20)->nullable();
        //     $table->date('po_accepted')->nullable();
        //     $table->char('e2e_pic', 20)->nullable();
        //     $table->char('long_aging', 30)->nullable();
        //     $table->char('project_pic', 20)->nullable();
        //     $table->char('region', 20)->nullable();
        //     $table->char('project_type', 20)->nullable();
        //     $table->char('po_line_ship', 20)->nullable();
        //     $table->char('account', 20)->nullable();
        //     $table->char('main_status', 20)->nullable();
        //     $table->char('status', 20)->nullable();
        //     $table->char('change_history', 20)->nullable();
        //     $table->char('rep_office', 20)->nullable();
        //     $table->char('customer', 20)->nullable();
        //     $table->char('project_code', 20)->nullable();
        //     $table->char('site_id', 20)->nullable();
        //     $table->char('subcontract_no', 20)->nullable();
        //     $table->char('pr_no', 20)->nullable();
        //     $table->char('po_status', 20)->nullable();
        //     $table->char('po_line_no', 20)->nullable();
        //     $table->char('shipment_no', 20)->nullable();
        //     $table->char('version_no', 20)->nullable();
        //     $table->char('item_code', 20)->nullable();
        //     $table->char('project_name', 20)->nullable();
        //     $table->char('site_code', 20)->nullable();
        //     $table->char('site_name', 20)->nullable();
        //     $table->string('item_description', 250)->nullable();
        //     $table->char('requested_qty', 20)->nullable();
        //     $table->char('due_qty', 20)->nullable();
        //     $table->char('billed_qty', 20)->nullable();
        //     $table->char('qty_cancel', 20)->nullable();
        //     $table->char('unit', 20)->nullable();
        //     $table->char('unit_price', 20)->nullable();
        //     $table->char('line_amount', 20)->nullable();
        //     $table->char('center_area', 20)->nullable();
        //     $table->char('bidding_area', 20)->nullable();
        //     $table->date('start_date')->nullable();
        //     $table->date('end_date')->nullable();
        //     $table->char('payment_method', 30)->nullable();
        //     $table->date('expired_date')->nullable();
        //     $table->date('publish_date')->nullable();
        //     $table->date('acceptance_date')->nullable();
        //     $table->string('note_to_receiver', 250)->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('po_tracking_ms_master');
        Schema::create('po_tracking_ms_master', function (Blueprint $table) {
            
            $table->char('pds', 30)->nullable();
            $table->char('approval_docs', 30)->nullable();
            $table->char('approved_verification', 30)->nullable();
            $table->char('acceptance_docs', 30)->nullable();
            $table->char('invoice', 30)->nullable();
            
        });
    }
}
