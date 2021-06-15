<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingMaterialEmployeeGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_material_group', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('training_material_group_employee', function (Blueprint $table) {
            $table->id();
            $table->integer('training_material_group_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->timestamps();
        });

        Schema::table('training_material', function (Blueprint $table) {
            $table->integer('training_material_group_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_material_employee_group');
    }
}
