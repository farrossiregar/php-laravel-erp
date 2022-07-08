<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldNoteRejectToPreventiveMaintenance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preventive_maintenance', function (Blueprint $table) {
            $table->boolean('is_reject')->default('0')->nullable();
            $table->text('note_reject')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preventive_maintenance', function (Blueprint $table) {
            //
        });
    }
}
