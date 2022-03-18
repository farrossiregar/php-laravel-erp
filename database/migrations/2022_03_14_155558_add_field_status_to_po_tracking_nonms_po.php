<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldStatusToPoTrackingNonmsPo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_po', function (Blueprint $table) {
            $table->boolean('status')->default(0)->nullable();
            $table->smallInteger('ordering')->default(0)->nullable();
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
