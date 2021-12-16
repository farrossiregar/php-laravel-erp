<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldEmployeeIdProjectIdToDutyrosterSitelistMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dutyroster_sitelist_master', function (Blueprint $table) {
            $table->integer('client_project_id')->nullable();
            $table->integer('employee_id')->nullable();
        });

        Schema::table('dutyroster_sitelist_detail', function (Blueprint $table) {
            $table->integer('client_project_id')->nullable();
            $table->integer('employee_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dutyroster_sitelist_master', function (Blueprint $table) {
            //
        });
    }
}
