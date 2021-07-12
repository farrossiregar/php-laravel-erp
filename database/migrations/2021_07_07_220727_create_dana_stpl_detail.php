<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanaStplDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dana_stpl_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('id_master')->nullable();
            $table->integer('region')->nullable();
            $table->integer('cmi')->nullable();
            $table->integer('h3i')->nullable();
            $table->integer('isat')->nullable();
            $table->integer('stp')->nullable();
            $table->integer('xl')->nullable();
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
        Schema::dropIfExists('dana_stpl_detail');
    }
}
