<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVatWhtToPoTrackingNonmsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_master', function (Blueprint $table) {
            $table->integer('vat')->nullable();
            $table->integer('vat_amount')->nullable();
            $table->integer('wht')->nullable();
            $table->integer('wht_amount')->nullable();
            $table->bigInteger('total_price_after_vat')->nullable();
            $table->bigInteger('total_invoice')->nullable();
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
