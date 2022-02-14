<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTreasuryToAccountPayable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_payable', function (Blueprint $table) {
            $table->char('bank_account_name', 30)->nullable();
            $table->char('bank_account_number', 30)->nullable();
            $table->char('bank_name', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_payable', function (Blueprint $table) {
            //
        });
    }
}
