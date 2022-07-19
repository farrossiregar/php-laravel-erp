<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRectificationBudget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rectification_budget', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable();
            $table->integer('client_project_id')->nullable();
            $table->integer('amount')->nullable();
            $table->smallInteger('year')->nullable();
            $table->integer('rectification_id')->nullable();
            $table->char('week',20)->nullable();
            $table->char('region', 50)->nullable();
            $table->char('subregion', 50)->nullable();
            $table->char('project', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('rectification_type', function (Blueprint $table) {
            $table->id();
            $table->string('name',200)->nullable();
            $table->integer('company_id')->nullable();
            $table->timestamps();

        });

        Schema::create('rectification_item', function (Blueprint $table) {
            $table->id();
            $table->integer('rectification_id')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->text('description')->nullable();
            $table->text('description_settle')->nullable();
            $table->bigInteger('amount_settle')->nullable();
            $table->timestamps();
        });

        Schema::table('account_payable_rectification', function (Blueprint $table) {
            $table->char('company_id', 10)->nullable();
            $table->char('total_transfer', 30)->nullable();
            $table->char('region', 100)->nullable();
            $table->char('subregion', 100)->nullable();
            $table->char('total_settlement', 30)->nullable();
            $table->char('employee_id', 30)->nullable();
            $table->string('app_staff_note')->nullable();
            $table->char('status', 10)->nullable();
            $table->char('previous_balance', 30)->nullable();
            $table->char('budget_opex', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rectification_budget');
    }
}
