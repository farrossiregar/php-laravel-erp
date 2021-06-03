<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePreventiveMaintenance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preventive_maintenance', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->date('due_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->timestamps();
        });

        Schema::create('preventive_maintenance_upload', function (Blueprint $table) {
            $table->id();
            $table->integer('preventive_maintenance')->nullable();
            $table->text('image')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('preventive_maintenance');
    }
}
