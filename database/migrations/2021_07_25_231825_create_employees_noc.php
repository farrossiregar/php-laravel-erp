<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesNoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_noc', function (Blueprint $table) {
            $table->id();
            $table->char('month', 2)->nullable();
            $table->char('year', 4)->nullable();
            $table->integer('jumlah_active')->nullable();
            $table->integer('jumlah_resign')->nullable();
            $table->char('status', 10)->nullable();
            $table->string('note', 100)->nullable();
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
        Schema::dropIfExists('employees_noc');
    }
}
