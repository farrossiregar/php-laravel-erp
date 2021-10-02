<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableIncidentReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_report', function (Blueprint $table) {
            $table->id();
            $table->string('incident_number',150)->nullable();
            $table->string('subject',250)->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('employee_pic_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->string('category',150)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('approve_date')->nullable();
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
        Schema::dropIfExists('incident_report');
    }
}
