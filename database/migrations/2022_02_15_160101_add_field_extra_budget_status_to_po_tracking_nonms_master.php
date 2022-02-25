<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldExtraBudgetStatusToPoTrackingNonmsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_master', function (Blueprint $table) {
            $table->boolean('status_extra_budget')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_tracking_nonms_master', function (Blueprint $table) {
            //
        });
    }
}
