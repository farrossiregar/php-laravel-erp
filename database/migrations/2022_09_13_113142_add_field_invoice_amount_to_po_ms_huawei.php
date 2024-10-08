<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldInvoiceAmountToPoMsHuawei extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_ms_huawei', function (Blueprint $table) {
            $table->bigInteger('invoice_amount')->default(0)->nullable();
            $table->integer('vat')->default(0)->nullable();
            $table->integer('wht')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_ms_huawei', function (Blueprint $table) {
            //
        });
    }
}
