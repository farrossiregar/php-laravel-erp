<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClaimcatToClaimingProcessLimit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('claiming_process_limit', function (Blueprint $table) {
            $table->char('entertainment', 20)->nullable();
            $table->char('medical', 20)->nullable();
            $table->char('transport', 20)->nullable();
            $table->char('parking', 20)->nullable();
            $table->char('employee_name', 20)->nullable();
            $table->char('nik', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claiming_process_limit', function (Blueprint $table) {
            //
        });
    }
}
