<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeekToWeeklyOpexBudget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weekly_opex_budget', function (Blueprint $table) {
            $table->integer('week_1')->nullable();
            $table->integer('week_2')->nullable();
            $table->integer('week_3')->nullable();
            $table->integer('week_4')->nullable();
            $table->integer('week_5')->nullable();
            $table->string('work_location',200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weekly_opex_budget', function (Blueprint $table) {
            //
        });
    }
}
