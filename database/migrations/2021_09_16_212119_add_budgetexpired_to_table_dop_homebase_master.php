<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBudgetexpiredToTableDopHomebaseMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dop_homebase_master', function (Blueprint $table) {
            $table->char('budget', 20)->after('type_homebase_dop');
            $table->dateTime('expired')->after('type_homebase_dop');
        });

        Schema::table('dutyroster_dophomebase_detail', function (Blueprint $table) {
            $table->char('budget', 20)->after('type_homebase_dop');
            $table->dateTime('expired')->after('type_homebase_dop');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_dop_homebase_master', function (Blueprint $table) {
            //
        });
    }
}
