<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableToolCheckToolbox extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toolbox_check', function (Blueprint $table) {
            $table->id();
            $table->integer('tools_check_id')->nullable();
            $table->integer('toolbox_id')->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->text('image')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('toolbox_check');
    }
}
