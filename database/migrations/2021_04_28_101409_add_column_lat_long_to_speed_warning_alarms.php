<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLatLongToSpeedWarningAlarms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('speed_warning_alarms', function (Blueprint $table) {
            $table->string('lat',100)->nullable();
            $table->string('long',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('speed_warning_alarms', function (Blueprint $table) {
            //
        });
    }
}
