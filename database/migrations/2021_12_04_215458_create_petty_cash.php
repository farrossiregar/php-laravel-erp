<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePettyCash extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petty_cash', function (Blueprint $table) {
            $table->id();
            $table->char('company_id', 10)->nullable();
            $table->char('project', 30)->nullable();
            $table->char('region', 30)->nullable();
            $table->char('amount', 20)->nullable();
            $table->char('keterangan', 20)->nullable();
            $table->char('settlement', 50)->nullable();
            $table->char('status', 10)->nullable();
            $table->char('note', 50)->nullable();
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
        Schema::dropIfExists('petty_cash');
    }
}
