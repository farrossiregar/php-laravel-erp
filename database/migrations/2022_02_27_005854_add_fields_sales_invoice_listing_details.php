<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsSalesInvoiceListingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_invoice_listing_details', function (Blueprint $table) {
            $table->char('credit_note_number', 50)->nullable();
            $table->char('aging_days', 10)->nullable();
            $table->char('deduction', 20)->nullable();
            $table->char('art23', 20)->nullable();
            $table->char('art4', 20)->nullable();
            $table->char('net_amount', 20)->nullable();
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
