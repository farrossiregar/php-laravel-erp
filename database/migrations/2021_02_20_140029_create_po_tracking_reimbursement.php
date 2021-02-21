<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoTrackingReimbursement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_tracking_reimbursement', function (Blueprint $table) {
            $table->id();
            $table->char('po_reimbursement_id', 20)->nullable();
            $table->integer('change_history')->nullable();
            $table->char('rep_office', 30)->nullable();
            $table->char('customer', 50)->nullable();
            $table->char('project_name', 50)->nullable();
            $table->char('project_code', 20)->nullable();
            $table->char('site_id', 20)->nullable();
            $table->string('sub_contract_no')->nullable();
            $table->char('pr_no', 20)->nullable();
            $table->string('sales_contract_no')->nullable();
            $table->integer('po_status')->nullable();
            $table->char('po_no', 15)->nullable();
            $table->string('site_code')->nullable();
            $table->string('site_name')->nullable();
            $table->integer('po_line_no')->nullable();
            $table->integer('shipment_no')->nullable();
            $table->string('item_description')->nullable();
            $table->integer('requested_qty')->nullable();
            $table->char('unit', 8)->nullable();
            $table->integer('unit_price')->nullable();
            $table->char('center_area', 50)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->float('billed_qty', 8, 2)->nullable();
            $table->float('due_qty', 12, 2)->nullable();
            $table->float('qty_cancel', 12, 2)->nullable();
            $table->char('item_code', 12)->nullable();
            $table->integer('version_no')->nullable();
            $table->integer('line_amount')->nullable();
            $table->char('bidding_area', 30)->nullable();
            $table->char('tax_rate', 10)->nullable();
            $table->char('currency', 10)->nullable();
            $table->string('ship_to')->nullable();
            $table->string('engineering_code')->nullable();
            $table->string('engineering_name')->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('category')->nullable();
            $table->string('payment_method')->nullable();
            $table->char('product_category', 10)->nullable();
            $table->string('bill_to')->nullable();
            $table->char('subproject_code', 10)->nullable();
            $table->date('expire_date')->nullable();
            $table->datetime('publish_date')->nullable();
            $table->date('acceptance_date')->nullable();
            $table->string('ff_buyer')->nullable();
            $table->string('note_to_receiver')->nullable();
            $table->string('fob_lookup_code')->nullable();
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
        Schema::dropIfExists('po_tracking_reimbursement');
    }
}
