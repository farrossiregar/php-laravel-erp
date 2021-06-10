<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTmgRanReportQuarterly extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmg_ran_report_quarterly', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->string('user_signum',100)->nullable();
            $table->string('resource_id',100)->nullable();
            $table->string('vendor_code',100)->nullable();
            $table->string('employee_lat',100)->nullable();
            $table->string('employee_lng',100)->nullable();
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
        Schema::dropIfExists('tmg_ran_report_quarterly');
    }
}
