<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientEmployeeIdToNocTeamSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_team_schedule', function (Blueprint $table) {
            $table->char('client_project_id', 10)->nullable();
            $table->char('employee_id', 10)->nullable();
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
