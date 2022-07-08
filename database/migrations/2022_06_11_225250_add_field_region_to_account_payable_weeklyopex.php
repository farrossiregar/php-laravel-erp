<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldRegionToAccountPayableWeeklyopex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_payable_weeklyopex', function (Blueprint $table) {
            $table->char('region', 100)->nullable();
            $table->char('subregion', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_payable_weeklyopex', function (Blueprint $table) {
            //
        });
    }
}
