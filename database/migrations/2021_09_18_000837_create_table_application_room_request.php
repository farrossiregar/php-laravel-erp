<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableApplicationRoomRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_room_request', function (Blueprint $table) {
            $table->id();
            $table->char('employee_id', 20)->nullable();
            $table->char('employee_name', 20)->nullable();
            $table->char('departement', 20)->nullable();
            $table->char('lokasi', 20)->nullable();
            $table->char('type_request', 20)->nullable();
            $table->char('request_room_detail', 50)->nullable();
            $table->dateTime('start_booking')->nullable();
            $table->dateTime('end_booking')->nullable();
            $table->string('purpose', 250)->nullable();
            $table->char('participant', 50)->nullable();
            $table->char('status', 20)->nullable();
            $table->string('note', 250)->nullable();
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
        Schema::dropIfExists('table_application_room_request');
    }
}
