<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumableItemRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumable_item_request', function (Blueprint $table) {
            $table->id();
            $table->char('employee_name', 30)->nullable();
            $table->char('nik', 30)->nullable();
            $table->char('item_name', 50)->nullable();
            $table->char('item_category', 30)->nullable();
            $table->char('amount', 30)->nullable();
            $table->char('price', 30)->nullable();
            $table->char('total_price', 30)->nullable();
            $table->char('release_dana_pettycash', 30)->nullable();
            $table->char('return_dana_pettycash', 30)->nullable();
            $table->char('status', 30)->nullable();
            $table->char('note', 30)->nullable();
            $table->timestamps();
        });

        Schema::create('consumable_item_database', function (Blueprint $table) {
            $table->id();
            $table->char('item_name', 50)->nullable();
            $table->char('item_category', 30)->nullable();
            $table->char('stock', 30)->nullable();
            $table->char('price', 30)->nullable();
            $table->timestamps();
        });

        Schema::create('hrga_petty_cash', function (Blueprint $table) {
            $table->id();
            $table->char('dana_release', 50)->nullable();
            $table->char('id_consumable_item_req', 30)->nullable();
            $table->char('settlement', 50)->nullable();
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
        Schema::dropIfExists('consumable_item_request');
    }
}
