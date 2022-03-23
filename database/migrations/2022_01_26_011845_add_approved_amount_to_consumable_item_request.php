<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovedAmountToConsumableItemRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumable_item_request', function (Blueprint $table) {
            $table->char('approved_amount', 30)->nullable();
            $table->char('settlement', 50)->nullable();
            $table->char('unused_amount', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consumable_item_request', function (Blueprint $table) {
            //
        });
    }
}
