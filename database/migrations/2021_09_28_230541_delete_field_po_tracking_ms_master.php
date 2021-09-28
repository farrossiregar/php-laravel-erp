<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteFieldPoTrackingMsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_ms_master', function (Blueprint $table) {
            $table->char('pds', 30)->nullable();
            $table->char('approval_docs', 30)->nullable();
            $table->char('approved_verification', 30)->nullable();
            $table->char('acceptance_docs', 30)->nullable();
            $table->char('invoice', 30)->nullable();
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
