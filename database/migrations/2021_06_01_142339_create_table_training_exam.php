<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTrainingExam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_exam', function (Blueprint $table) {
            $table->id();
            $table->integer('training_material_id')->nullable();
            $table->text('soal')->nullable();
            $table->boolean('jenis_soal')->nullable();
            $table->boolean('kunci_jawaban')->nullable();
            $table->integer('nilai_soal')->nullable();
            $table->timestamps();
        });


        Schema::create('training_exam_submit', function (Blueprint $table) {
            $table->id();
            $table->integer('training_material_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->text('training_exam_id')->nullable();
            $table->text('jawaban')->nullable();
            $table->timestamps();
        });

        Schema::create('training_exam_jawaban', function (Blueprint $table) {
            $table->id();
            $table->integer('training_exam_id')->nullable();
            $table->text('jawaban')->nullable();
            $table->boolean('key')->nullable();
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
        Schema::dropIfExists('training_exam');
    }
}
