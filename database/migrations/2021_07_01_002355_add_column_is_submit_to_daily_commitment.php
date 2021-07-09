<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsSubmitToDailyCommitment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commitment_dailys', function (Blueprint $table) {
            $table->boolean('is_submit')->default(0);
        });

        Schema::table('ppe_check', function (Blueprint $table) {
            $table->boolean('is_submit')->default(0);
        });

        Schema::table('health_check', function (Blueprint $table) {
            $table->boolean('is_submit')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_commitment', function (Blueprint $table) {
            //
        });
    }
}
