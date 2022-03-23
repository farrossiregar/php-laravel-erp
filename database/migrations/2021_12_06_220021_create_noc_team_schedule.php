<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNocTeamSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noc_team_schedule', function (Blueprint $table) {
            $table->id();
            $table->char('company_name', 6)->nullable();
            $table->char('project', 30)->nullable();
            $table->char('region', 30)->nullable();
            $table->char('name', 30)->nullable();
            $table->char('position', 30)->nullable();
            $table->datetime('start_schedule')->nullable();
            $table->datetime('end_schedule')->nullable();
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
        Schema::dropIfExists('noc_team_schedule');
    }
}
