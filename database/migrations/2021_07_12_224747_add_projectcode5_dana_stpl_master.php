<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjectcode5DanaStplMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dana_stpl_master', function (Blueprint $table) {
            $table->integer('cmi')->nullable()->after('danastpl');
            $table->integer('h3i')->nullable()->after('danastpl');
            $table->integer('isat')->nullable()->after('danastpl');
            $table->integer('stp')->nullable()->after('danastpl');
            $table->integer('xl')->nullable()->after('danastpl');
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
