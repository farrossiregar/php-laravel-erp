<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelFlightTicketRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_flight_ticket_request', function (Blueprint $table) {
            $table->id();
            $table->char('company_name', 6)->nullable();
            $table->char('project', 30)->nullable();
            $table->char('region', 30)->nullable();
            $table->char('name', 30)->nullable();
            $table->char('position', 30)->nullable();
            $table->date('date')->nullable();
            $table->char('ticket_type', 20)->nullable();
            $table->char('category', 20)->nullable();
            $table->char('arrival_airport', 30)->nullable();
            $table->char('departure_airport', 30)->nullable();
            $table->char('meeting_location', 30)->nullable();
            $table->char('attachment', 50)->nullable();
            $table->dateTime('arrival_time')->nullable();
            $table->dateTime('departure_time')->nullable();
            $table->char('airline', 10)->nullable();
            $table->char('agency', 10)->nullable();
            $table->char('flight_price', 10)->nullable();
            $table->char('hotel_price', 10)->nullable();
            $table->char('hotel_location', 30)->nullable();
            $table->char('hotel_name', 30)->nullable();
            $table->char('status', 10)->nullable();
            $table->char('note', 50)->nullable();
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
        Schema::dropIfExists('hotel_flight_ticket_request');
    }
}
