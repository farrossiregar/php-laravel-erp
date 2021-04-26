<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSpeedWarningAlarm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speed_warning_alarms', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->string('speed',5)->nullable();
            $table->text('employee')->nullable();
            $table->text('vehicle')->nullable();
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
        Schema::dropIfExists('speed_warning_alarms');
    }
}
