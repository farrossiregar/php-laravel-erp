<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountPayableSuppliervendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_payable_suppliervendor', function (Blueprint $table) {
            $table->id();
            $table->char('request_detail_option', 30)->nullable();
            $table->char('project_code', 30)->nullable();
            $table->char('project_name', 30)->nullable();
            $table->char('invoice_no', 30)->nullable();
            $table->date('invoice_date')->nullable();
            $table->char('top', 30)->nullable();
            $table->date('due_date')->nullable();
            $table->char('supplier_vendor_name', 30)->nullable();
            $table->char('pr_no', 100)->nullable();
            $table->char('po_no', 100)->nullable();
            $table->char('description', 100)->nullable();
            $table->char('qty', 10)->nullable();
            $table->char('unit_price', 20)->nullable();
            $table->char('shipping_price', 20)->nullable();
            $table->char('total_price', 20)->nullable();
            $table->char('otehr_host', 20)->nullable();
            $table->char('vat', 30)->nullable();
            $table->char('wht', 30)->nullable();
            $table->char('total_payment', 20)->nullable();
            $table->char('actual_payment', 20)->nullable();
            $table->char('advance', 20)->nullable();
            $table->char('percentage_actual_payment', 20)->nullable();
            $table->char('actual_transfer_date', 20)->nullable();
            $table->char('cash_transaction_no', 100)->nullable();
            $table->date('tgl_narik_data')->nullable();
            $table->char('ap_amount', 20)->nullable();
            $table->char('request_doc', 30)->nullable();
            $table->char('payment_voucher_doc', 30)->nullable();
            $table->char('settlement_doc', 30)->nullable();
            
            $table->char('account_no_recorded', 30)->nullable();
            $table->char('account_name_recorded', 30)->nullable();
            $table->char('nominal_recorded', 30)->nullable();

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
        Schema::dropIfExists('account_payable_suppliervendor');
    }
}
