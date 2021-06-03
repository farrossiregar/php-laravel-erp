<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDrugTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_test', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_pic_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->boolean('status_drug')->default(0)->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->timestamps();
        });

        Schema::create('drug_test_upload', function (Blueprint $table) {
            $table->id();
            $table->integer('drug_test_id')->nullable();
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
        Schema::dropIfExists('drug_test');
    }
}
