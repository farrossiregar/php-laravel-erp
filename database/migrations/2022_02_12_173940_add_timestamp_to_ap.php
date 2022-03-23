<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampToAp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      

        Schema::table('account_payable_otheropex', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('account_payable_rectification', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('account_payable_weeklyopex', function (Blueprint $table) {
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
        Schema::table('ap', function (Blueprint $table) {
            //
        });
    }
}
