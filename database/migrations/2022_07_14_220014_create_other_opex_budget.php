<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherOpexBudget extends Migration
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
            $table->integer('client_project_id')->nullable();
            $table->integer('other_opex_id')->nullable();
            $table->bigInteger('amount')->nullable();
            // $table->string('week',100)->nullable();
            $table->timestamps();
        });

        Schema::create('other_opex_type', function (Blueprint $table) {
            $table->id();
            $table->string('name',200)->nullable();
            $table->integer('company_id')->nullable();
            $table->timestamps();

        });

        Schema::create('other_opex_item', function (Blueprint $table) {
            $table->id();
            $table->integer('other_opex_id')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->text('description')->nullable();
            $table->text('description_settle')->nullable();
            $table->bigInteger('amount_settle')->nullable();
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
