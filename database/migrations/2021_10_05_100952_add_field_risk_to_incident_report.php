<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldRiskToIncidentReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incident_report', function (Blueprint $table) {
            $table->string('risk',15)->nullable();
            $table->text('impact')->nullable();
            $table->text('root_cause')->nullable();
            $table->text('action_plan')->nullable();
            $table->text('recommendation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incident_report', function (Blueprint $table) {
            //
        });
    }
}
