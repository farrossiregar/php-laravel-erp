<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTroubleTicker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trouble_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_table',150)->nullable();
            $table->integer('transaction_id')->nullable();
            $table->string('subject',255)->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(1)->nullable()->comment = '1=Open,2=Proccess,3=Solved';
            $table->text('file')->nullable();
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
        Schema::dropIfExists('trouble_tickets');
    }
}
