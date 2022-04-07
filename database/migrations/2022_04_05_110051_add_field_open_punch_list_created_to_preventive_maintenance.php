<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldOpenPunchListCreatedToPreventiveMaintenance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preventive_maintenance', function (Blueprint $table) {
            $table->date('open_punch_list_created')->nullable();
            $table->date('tt_number_created')->nullable();
            $table->date('boq_evidence_created')->nullable();
            $table->date('boq_created')->nullable();
            $table->date('rec_evidence_created')->nullable();
            $table->date('rec_feat_created')->nullable();
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
