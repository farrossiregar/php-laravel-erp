<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddYearmonthToDatabaseToolsNoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tools_noc', function (Blueprint $table) {
            $table->char('month', 20)->nullable();
            $table->char('year', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('database_tools_noc', function (Blueprint $table) {
            //
        });
    }
}
