<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInvoiceListingDetaildesc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice_listing_detaildesc', function (Blueprint $table) {
            $table->id();
            $table->char('id_master', '20')->nullable();
            $table->char('item_description', 100)->nullable();
            $table->char('currency', 20)->nullable();
            $table->char('qty', 20)->nullable();
            $table->char('price_perunit', 30)->nullable();
            $table->char('total', 30)->nullable();
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
        Schema::dropIfExists('sales_invoice_listing_detaildesc');
    }
}
