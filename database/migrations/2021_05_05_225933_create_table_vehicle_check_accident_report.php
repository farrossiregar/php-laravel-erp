<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVehicleCheckAccidentReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_check_accident_report', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle_check_id')->nullable();
            $table->text('image')->nullable();
            $table->timestamps();
        });

        Schema::create('vehicle_check_cleanliness', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle_check_id')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('vehicle_check_accident_report');
    }
}
