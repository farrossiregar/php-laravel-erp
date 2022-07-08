<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyOpexItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_opex_item', function (Blueprint $table) {
            $table->id();
            $table->integer('weekly_opex_id')->nullable();
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
        Schema::dropIfExists('weekly_opex_item');
    }
}
