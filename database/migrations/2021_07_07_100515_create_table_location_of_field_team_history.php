<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLocationOfFieldTeamHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_of_field_team_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->text('employee_raw')->nullable();
            $table->string('lat',255)->nullable();
            $table->string('long',255)->nullable();
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
        Schema::dropIfExists('location_of_field_team_histories');
    }
}
