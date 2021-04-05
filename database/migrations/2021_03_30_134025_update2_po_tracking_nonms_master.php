<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Update2PoTrackingNonmsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_master', function (Blueprint $table) {
            $table->text('status_note')->nullable();
            $table->integer('bast_status')->nullable();
            $table->text('bast_status_note')->nullable();
            $table->char('bast', 30)->nullable();
            $table->char('approved_bast', 30)->nullable();
            $table->char('gr_cust', 30)->nullable();
            $table->char('acc_doc', 30)->nullable();
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
