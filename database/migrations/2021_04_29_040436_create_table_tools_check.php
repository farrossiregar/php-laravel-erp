<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableToolsCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools_check', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->string('bulan',2)->nullable();
            $table->string('tahun',4)->nullable();
            $table->timestamps();
        });

        Schema::create('tools_check_upload', function (Blueprint $table) {
            $table->id();
            $table->integer('tools_check_id')->nullable();
            $table->integer('tools_check_item_id')->nullable();
            $table->text('image')->nullable();
            $table->timestamps();
        });

        Schema::create('tools_check_items', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable();
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
        Schema::dropIfExists('tools_checks');
    }
}
