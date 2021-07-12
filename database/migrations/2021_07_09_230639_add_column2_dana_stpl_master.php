<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumn2DanaStplMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dana_stpl_master', function($table) {
            $table->dropColumn(['id_no', 'note_sm', 'note_psm', 'note_ms']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dana_stpl_master', function (Blueprint $table) {
            $table->integer('id_no');
            $table->string('note_sm');
            $table->string('note_psm');
            $table->string('note_ms');
            
        });
    }
}
