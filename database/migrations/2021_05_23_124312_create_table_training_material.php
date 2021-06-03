<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTrainingMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_material', function (Blueprint $table) {
            $table->id();
            $table->string('name',200)->nullable();
            $table->date('from_date')->nullable();
            $table->date('end_date')->nullable();
            $table->tinyInteger('days')->nullable();
            $table->text('place')->nullable();
            $table->timestamps();
        });

        Schema::create('training_material_employee', function (Blueprint $table) {
            $table->id();
            $table->integer('training_material_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->timestamps();
        });

        Schema::create('training_material_employee_upload', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->integer('training_material_id')->nullable();
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
        Schema::dropIfExists('training_material');
    }
}
