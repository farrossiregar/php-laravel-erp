<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldIdMasterDutyrosterToDutyrosterDophomebaseDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dutyroster_dophomebase_detail', function (Blueprint $table) {
            $table->char('id_master_dutyroster', 100)->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dutyroster_dophomebase_detail', function (Blueprint $table) {
            //
        });
    }
}
