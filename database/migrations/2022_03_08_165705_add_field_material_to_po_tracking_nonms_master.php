<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldMaterialToPoTrackingNonmsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_master', function (Blueprint $table) {
            $table->string('category_material',100)->nullable();
            $table->string('item',200)->nullable();
            $table->string('uom',50)->nullable();
            $table->smallInteger('qty')->nullable();
            $table->integer('unit_price')->nullable();
            $table->string('sno_material',50)->nullable();
            $table->string('sno_rectification',50)->nullable();
            $table->string('po_',12)->nullable();
            $table->string('po_line_item',12)->nullable();
            $table->string('gr_no',50)->nullable();
            $table->date('gr_date')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('no_invoice',100)->nullable();
            $table->date('payment_date')->nullable();
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
