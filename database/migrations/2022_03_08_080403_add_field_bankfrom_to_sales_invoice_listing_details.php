<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldBankfromToSalesInvoiceListingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_invoice_listing_details', function (Blueprint $table) {
            $table->char('bank_from', 30)->nullable();
            $table->char('account_number_from', 30)->nullable();
            $table->char('pic_from', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_invoice_listing_details', function (Blueprint $table) {
            //
        });
    }
}
