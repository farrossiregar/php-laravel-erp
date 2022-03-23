<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesheetRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheet_record', function (Blueprint $table) {
            $table->id();
            $table->char('project', 50)->nullable();
            $table->char('company_name', 30)->nullable();
            $table->char('region', 30)->nullable();
            $table->char('overtime', 30)->nullable();
            $table->char('month', 10)->nullable();
            $table->char('year', 10)->nullable();
            $table->char('status', 10)->nullable();
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
        Schema::dropIfExists('timesheet_record');
    }
}
