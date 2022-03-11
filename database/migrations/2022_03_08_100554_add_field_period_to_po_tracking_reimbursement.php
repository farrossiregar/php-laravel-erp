<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldPeriodToPoTrackingReimbursement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_reimbursement', function (Blueprint $table) {
            $table->date('po_date')->nullable();
            $table->date('period')->nullable();
            $table->string('region',100)->nullable();
            $table->string('branch',100)->nullable();
            $table->string('boq',100)->nullable();
            $table->string('gr_no',100)->nullable();
            $table->date('gr_date')->nullable();
            $table->string('invoice_no',100)->nullable();
            $table->date('invoice_date')->nullable();
            $table->integer('actual_amount')->nullable();
            $table->integer('amunt_to_be_claim')->nullable();
            $table->date('date_of_payment')->nullable();
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
