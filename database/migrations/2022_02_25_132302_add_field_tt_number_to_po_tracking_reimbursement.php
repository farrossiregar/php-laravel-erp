<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTtNumberToPoTrackingReimbursement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_reimbursement', function (Blueprint $table) {
            $table->string('cluster',100)->nullable();
            $table->string('sub_cluster',100)->nullable();
            $table->string('tt_number',100)->nullable();
            $table->string('duration',10)->nullable();
            $table->integer('capacity_kva')->nullable();
            $table->string('std_fuel_consump',12)->nullable();
            $table->decimal('fuel_consumption_used',4,2)->nullable();
            $table->date('date_refuel')->nullable();
            $table->decimal('fuel_refuel',4,2)->nullable();
            $table->string('bbm_type',25)->nullable();
            $table->string('article_code',25)->nullable();
            $table->integer('price_liter')->nullable();
            $table->integer('total_price')->nullable();
            $table->integer('acceptable_amount')->nullable();
            $table->text('eid_check')->nullable();
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
