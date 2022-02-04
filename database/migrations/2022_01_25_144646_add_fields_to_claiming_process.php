<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToClaimingProcess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('claiming_process', function (Blueprint $table) {
            $table->char('entertainment', 20)->nullable();
            $table->char('medical', 20)->nullable();
            $table->char('transport', 20)->nullable();
            $table->char('parking', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claiming_process', function (Blueprint $table) {
            //
        });
    }
}
