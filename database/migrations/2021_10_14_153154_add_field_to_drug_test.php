<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToDrugTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drug_test', function (Blueprint $table) {
            $table->integer('region_id')->nullable();
            $table->integer('sub_region_id')->nullable();
            $table->integer('client_project_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drug_test', function (Blueprint $table) {
            //
        });
    }
}
