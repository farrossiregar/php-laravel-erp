<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseBudgetPetty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petty_cash_budget', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable();
            $table->smallInteger('year')->nullable();
            $table->integer('department_id')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->bigInteger('used')->nullable();
            $table->bigInteger('remain')->nullable();
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
        Schema::dropIfExists('budget_petty_cash');
    }
}
