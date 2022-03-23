<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNikClientProjectIdToHotelFlightTicketRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_flight_ticket_request', function (Blueprint $table) {
            $table->char('nik', 10)->nullable();
            $table->char('client_project_id', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_flight_ticket_request', function (Blueprint $table) {
            //
        });
    }
}
