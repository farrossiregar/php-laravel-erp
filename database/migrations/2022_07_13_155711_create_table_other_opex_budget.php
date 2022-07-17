<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOtherOpexBudget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_opex_budget', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable();
            $table->integer('client_project_id')->nullable();
            $table->integer('amount')->nullable();
            $table->smallInteger('year')->nullable();
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
        Schema::dropIfExists('other_opex_budget');
    }
}
