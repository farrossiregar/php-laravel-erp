<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartEndActualToNocTeamSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_team_schedule', function (Blueprint $table) {
            $table->datetime('start_actual')->nullable();
            $table->datetime('end_actual')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('noc_team_schedule', function (Blueprint $table) {
            //
        });
    }
}
