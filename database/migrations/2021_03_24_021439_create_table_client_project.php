<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableClientProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name',150)->nullable();
            $table->timestamps();
        });
        Schema::create('client_project_pic', function (Blueprint $table) {
            $table->id();
            $table->integer('client_project_id')->nullable();
            $table->integer('employee_id')->nullable();
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
        Schema::dropIfExists('client_projects');
    }
}
