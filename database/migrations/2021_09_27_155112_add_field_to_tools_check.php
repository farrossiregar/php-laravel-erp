<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToToolsCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tools_check', function (Blueprint $table) {
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
        Schema::table('tools_check', function (Blueprint $table) {
            //
        });
    }
}
