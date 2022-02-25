<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldBastNumberToPoTrackingReimbursement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_reimbursement', function (Blueprint $table) {
            $table->string('bast_number')->nullable();
            $table->date('bast_approved')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_tracking_reimbursement', function (Blueprint $table) {
            //
        });
    }
}
