<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldIndexToCommitmentDailys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commitment_dailys', function (Blueprint $table) {
            $table->index(['employee_id']);
        });
        Schema::table('health_check', function (Blueprint $table) {
            $table->index(['employee_id']);
        });
        Schema::table('vehicle_check', function (Blueprint $table) {
            $table->index(['employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commitment_dailys', function (Blueprint $table) {
            //
        });
    }
}
