<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldStatusPunchListToPreventiveMaintenance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preventive_maintenance', function (Blueprint $table) {
            $table->boolean('status_punch_list_tmg')->default(0)->nullable();
            $table->boolean('status_punch_list_tlp')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preventive_maintenance', function (Blueprint $table) {
            //
        });
    }
}
