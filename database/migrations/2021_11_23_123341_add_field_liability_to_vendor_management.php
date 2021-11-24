<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldLiabilityToVendorManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_management', function (Blueprint $table) {
            $table->string('balance_2017_liabiity',20)->nullable();
            $table->string('balance_2018_liabiity',20)->nullable();
            $table->string('balance_2019_liabiity',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_management', function (Blueprint $table) {
            //
        });
    }
}
