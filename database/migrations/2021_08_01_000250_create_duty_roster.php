<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDutyRoster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        // Schema::create('dutyroster_sitelist_master', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer('status')->nullable();
        //     $table->text('note')->nullable();
        //     $table->timestamps();
        // });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duty_roster');
    }
}
