<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToToolboxCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('toolbox_check', function (Blueprint $table) {
            $table->integer('employee_id')->nullable();
            $table->integer('client_project_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('sub_region_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('toolbox_check', function (Blueprint $table) {
            //
        });
    }
}
