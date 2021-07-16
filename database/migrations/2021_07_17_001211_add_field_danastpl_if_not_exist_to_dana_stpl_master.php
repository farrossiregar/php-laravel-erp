<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldDanastplIfNotExistToDanaStplMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasColumn('dana_stpl_master', 'danastpl')){
            Schema::table('dana_stpl_master', function (Blueprint $table) {
                $table->integer('danastpl')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dana_stpl_master', function (Blueprint $table) {
            //
        });
    }
}
