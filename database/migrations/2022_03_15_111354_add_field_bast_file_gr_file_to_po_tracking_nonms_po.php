<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldBastFileGrFileToPoTrackingNonmsPo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_po', function (Blueprint $table) {
            $table->text('bast_file')->nullable();
            $table->text('gr_file')->nullable();
            $table->text('acceptance_file')->nullable();
            $table->text('invoice_file')->nullable();
            $table->integer('extra_budget')->nullable();
            $table->text('extra_budget_file')->nullable();
            $table->boolean('status_extra_budget')->nullable();
            $table->text('note_extra_budget')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_tracking_nonms_po', function (Blueprint $table) {
            //
        });
    }
}
