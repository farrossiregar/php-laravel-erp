<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldNoteSmToDanaStplMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('dana_stpl_master', 'id_no')){
            Schema::table('dana_stpl_master', function (Blueprint $table) {
                $table->integer('id_no');
            });
        }
        if (!Schema::hasColumn('dana_stpl_master', 'note_sm')){
            Schema::table('dana_stpl_master', function (Blueprint $table) {
                $table->string('note_sm');
            });
        }
        if (!Schema::hasColumn('dana_stpl_master', 'note_psm')){
            Schema::table('dana_stpl_master', function (Blueprint $table) {
                $table->string('note_psm');
            });
        }
        if (!Schema::hasColumn('dana_stpl_master', 'note_ms')){
            Schema::table('dana_stpl_master', function (Blueprint $table) {
                $table->string('note_ms');
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
