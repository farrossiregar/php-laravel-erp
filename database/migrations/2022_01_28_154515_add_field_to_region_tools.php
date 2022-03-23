<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToRegionTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('region_tools', function (Blueprint $table) {
            $table->integer('project_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('sm_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('pic_id')->nullable();
            $table->text('remark')->nullable();
            $table->string('current_position',100)->nullable();
            $table->string('status_asset',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('region_tools', function (Blueprint $table) {
            //
        });
    }
}
