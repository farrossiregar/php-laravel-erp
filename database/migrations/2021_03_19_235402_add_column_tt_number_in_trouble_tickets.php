<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTtNumberInTroubleTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trouble_tickets', function (Blueprint $table) {
            $table->string('trouble_ticket_number',255)->after('transaction_table')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trouble_tickets', function (Blueprint $table) {
            //
        });
    }
}
