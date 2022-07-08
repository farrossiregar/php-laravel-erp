<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldDescriptionToPettyCashItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('petty_cash_items', function (Blueprint $table) {
            $table->text('description_settle')->nullable();
            $table->bigInteger('amount_settle')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('petty_cash_items', function (Blueprint $table) {
            //
        });
    }
}
