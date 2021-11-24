<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankNameToVendorManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_management', function (Blueprint $table) {
            $table->string('bank_name',50)->nullable();
            $table->string('bank_address',50)->nullable();
            $table->string('country',50)->nullable();
            $table->string('currency',10)->nullable();
            $table->string('bank_account_owner',50)->nullable();
            $table->string('bank_account_number',25)->nullable();
            $table->string('swift_code',25)->nullable();
            $table->string('notas_finance',25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_management', function (Blueprint $table) {
            //
        });
    }
}
