<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSerialNumberToToolboxCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('toolbox_check', function (Blueprint $table) {
            $table->string('serial_number',255)->nullable();
            $table->integer('toolbox_type_id')->nullable();
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
