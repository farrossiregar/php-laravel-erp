<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInvoiceListingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice_listing_details', function (Blueprint $table) {
            $table->id();
            $table->char('kind_of_invoice', 30)->nullable();
            $table->char('project_code', 30)->nullable();
            $table->char('project_name', 30)->nullable();
            $table->char('cust_name', 30)->nullable();
            $table->char('invoice_date', 30)->nullable();
            $table->char('invoice_no', 30)->nullable();
            $table->char('tax_invoice_no', 50)->nullable();
            $table->char('month', 20)->nullable();
            $table->char('year', 20)->nullable();
            $table->char('region', 20)->nullable();
            $table->char('po_no', 30)->nullable();
            $table->char('po_date', 30)->nullable();
            $table->char('invoice_description', 100)->nullable();
            $table->char('currency', 20)->nullable();
            $table->char('qty', 20)->nullable();
            $table->char('price_perunit', 30)->nullable();
            $table->char('total', 30)->nullable();
            $table->char('top', 30)->nullable();
            $table->date('schedule_payment_date')->nullable();
            $table->date('ar_aging_date')->nullable();
            $table->char('ar_aging_amount', 30)->nullable();
            $table->date('actual_payment_date')->nullable();
            $table->char('cash_transaction_no', 50)->nullable();
            $table->char('paid_amount_bank', 50)->nullable();
            $table->char('bank', 30)->nullable();
            $table->char('account_number', 30)->nullable();
            $table->char('difference', 30)->nullable();
            $table->char('pic', 30)->nullable();
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
        Schema::dropIfExists('sales_invoice_listing_details');
    }
}
