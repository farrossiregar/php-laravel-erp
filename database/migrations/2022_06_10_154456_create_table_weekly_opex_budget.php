<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableWeeklyOpexBudget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_opex_budget', function (Blueprint $table) {
            $table->id();
            $table->integer('client_project_id')->nullable();
            $table->integer('weekly_opex_id')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->string('week',100)->nullable();
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
        Schema::dropIfExists('weekly_opex_budget');
    }
}
