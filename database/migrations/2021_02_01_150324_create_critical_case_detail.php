<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriticalCaseDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('critical_case_detail', function (Blueprint $table) {
            $table->id();
            $table->char('pic', 100)->nullable();
            $table->integer('shift_number')->nullable();
            $table->date('date')->nullable();
            $table->string('activity_handling')->nullable();
            $table->dateTime('time_occur')->nullable();
            $table->char('severity', 10)->nullable();
            $table->char('project', 10)->nullable();
            $table->char('region', 20)->nullable();
            $table->char('category', 20)->nullable();
            $table->char('impact', 100)->nullable();
            $table->char('action', 100)->nullable();
            $table->char('customer_handling', 50)->nullable();
            $table->dateTime('time_closed')->nullable();
            $table->integer('status')->nullable();
            $table->string('last_update')->nullable();
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
        Schema::dropIfExists('critical_case_detail');
    }
}
