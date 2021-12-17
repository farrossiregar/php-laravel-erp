<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle', function (Blueprint $table) {
            $table->id();
            $table->string('no_polisi')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('vehicle_check_id')->nullable();
            $table->integer('client_project_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('sub_region_id')->nullable();
            $table->string('sim',2)->nullable();
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
        Schema::dropIfExists('vehicle');
    }
}
