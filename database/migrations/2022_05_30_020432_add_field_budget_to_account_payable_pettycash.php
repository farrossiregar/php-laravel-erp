<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldBudgetToAccountPayablePettycash extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_payable_pettycash', function (Blueprint $table) {
            $table->bigInteger('budget')->default(0)->nullable();
            $table->bigInteger('remain')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_payable_pettycash', function (Blueprint $table) {
            //
        });
    }
}
