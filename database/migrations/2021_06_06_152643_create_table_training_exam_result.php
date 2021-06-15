<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTrainingExamResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_exam_result', function (Blueprint $table) {
            $table->id();
            $table->integer('training_material_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('nilai')->nullable();
            $table->integer('total_soal')->nullable();
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
        Schema::dropIfExists('training_exam_result');
    }
}
