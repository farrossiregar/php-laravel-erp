<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDutyrosterFlmengineerMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dutyroster_flmengineer_master', function (Blueprint $table) {
            $table->char('status', 10)->nullable()->after('id');
            $table->string('note', 100)->nullable()->after('id');
            $table->char('user_id', 50)->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
