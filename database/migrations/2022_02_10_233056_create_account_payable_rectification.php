<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountPayableRectification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_payable_rectification', function (Blueprint $table) {
            $table->id();
            $table->char('id_master', 30)->nullable();
            $table->char('project_code', 30)->nullable();
            $table->char('project_name', 30)->nullable();
            $table->char('month', 20)->nullable();
            $table->char('year', 20)->nullable();
            $table->char('week', 20)->nullable();
            $table->char('rect_name', 20)->nullable();
            $table->char('pr_no', 100)->nullable();
            $table->char('nominal', 30)->nullable();
            $table->date('transfer_date')->nullable();
            $table->char('cash_transaction_no', 100)->nullable();
            $table->char('advance', 20)->nullable();
            $table->date('settlement_date')->nullable();
            $table->char('settlement_nominal', 30)->nullable();
            $table->char('difference', 30)->nullable();
            $table->char('remarks', 30)->nullable();
            $table->char('account_no_recorded', 30)->nullable();
            $table->char('account_name_recorded', 30)->nullable();
            $table->char('nominal_recorded', 30)->nullable();
            $table->char('doc_settlement', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_payable_rectification');
    }
}
