<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLogActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_activity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject',191)->nullable();
            $table->string('url',255)->nullable();
            $table->string('method',50)->nullable();
            $table->string('ip',50)->nullable();
            $table->string('agent',250)->nullable();
            $table->integer('user_id')->nullable();
            $table->text('var')->nullable();
            $table->text('device')->nullable();
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
        Schema::dropIfExists('log_activity');
    }
}
