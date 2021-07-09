<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDanaStplMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dana_stpl_master', function (Blueprint $table) {
            $table->id();
            $table->integer('id_no')->nullable();
            $table->integer('status')->nullable();
            $table->text('company')->nullable();
            $table->text('note_sm')->nullable();
            $table->text('note_ms')->nullable();
            $table->text('note_psm')->nullable();
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
        //
    }
}
