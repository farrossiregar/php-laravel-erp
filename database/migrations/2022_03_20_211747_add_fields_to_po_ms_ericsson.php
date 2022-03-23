<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPoMsEricsson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_ms_ericsson', function (Blueprint $table) {
            $table->string('po_no',100)->nullable();
            $table->string('item_number',10)->nullable();
            $table->string('po_line_item',30)->nullable();
            $table->date('date_po_released')->nullable();
            $table->char('type', 10)->nullable();
            $table->string('item_description', 250)->nullable();
            $table->string('period', 20)->nullable();
            $table->string('region', 30)->nullable();
            $table->string('last_status', 50)->nullable();
            $table->string('no_bast', 50)->nullable();
            $table->char('qty_po', 30)->nullable();
            $table->char('qty_po_penagihan_60', 30)->nullable();
            $table->char('gap_100_60', 30)->nullable();
            $table->char('actual_qty', 20)->nullable();
            $table->char('pm_w', 20)->nullable();
            $table->char('pm_ny', 20)->nullable();
            $table->char('site_po_deduction', 20)->nullable();
            $table->char('price_unit', 20)->nullable();
            $table->char('po_amount_actual', 20)->nullable();
            $table->char('po_amount_after_deduction', 20)->nullable();
            $table->char('penalty', 20)->nullable();
            $table->char('amount_penalty', 20)->nullable();
            $table->char('no_cn', 20)->nullable();
            $table->date('date_submit_cn')->nullable();

            $table->date('date_bast_approval')->nullable();
            $table->date('date_bast_approval_system')->nullable();
            $table->date('date_gr_req')->nullable();
            $table->char('no_gr', 20)->nullable();
            $table->date('date_gr_share')->nullable();
            $table->char('invoice_amount', 20)->nullable();
            $table->char('no_inv', 30)->nullable();
            $table->date('inv_date')->nullable();

            $table->date('payment_date')->nullable();

            $table->date('date_bast_approval2')->nullable();
            $table->date('date_bast_approval_system2')->nullable();
            $table->date('date_gr_req2')->nullable();
            $table->char('no_gr2', 20)->nullable();
            $table->date('date_gr_share2')->nullable();
            $table->char('invoice_amount2', 20)->nullable();
            $table->char('no_inv2', 30)->nullable();
            $table->date('inv_date2')->nullable();

            $table->char('qty_site_hold', 30)->nullable();
            $table->char('type2', 30)->nullable();
            $table->char('amount_hold_payment', 30)->nullable();
            $table->char('closing_site', 30)->nullable();
            $table->char('no_bast2', 30)->nullable();
            $table->char('claim', 30)->nullable();

            $table->date('date_bast_approval3')->nullable();
            $table->date('date_bast_approval_system3')->nullable();
            $table->char('req_gr', 30)->nullable();
            $table->char('gr_number', 30)->nullable();
            $table->date('date_gr_number_share')->nullable();
            $table->char('no_inv3', 30)->nullable();
            $table->date('inv_date3')->nullable();

            $table->char('status_claim_hold_payment', 50)->nullable();
            $table->char('amount_closing_site_hold_payment', 50)->nullable();

            $table->char('no_bast3', 50)->nullable();
            $table->char('closing_site2', 50)->nullable();
            $table->char('claim2', 50)->nullable();
            $table->char('status_backlog_h1', 50)->nullable();
            $table->char('no_gr3', 50)->nullable();
            $table->date('date_gr_share3')->nullable();
            $table->char('no_inv_backlog_h1', 50)->nullable();
            $table->date('date_inv_backlog_h1')->nullable();
            $table->char('amount_closing_site_backlog_h1', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_ms_ericsson', function (Blueprint $table) {
            //
        });
    }
}
