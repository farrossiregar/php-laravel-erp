<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoMsHuawei extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_ms_huawei', function (Blueprint $table) {
            $table->id();
            $table->string('po_no',100)->nullable();
            $table->string('po_line_shipment',100)->nullable();
            $table->char('region',30)->nullable();
            $table->char('site_id',30)->nullable();
            $table->char('site_name',30)->nullable();
            $table->char('po_period',30)->nullable();
            $table->char('type_po',30)->nullable();
            $table->char('po_category',30)->nullable();
            $table->string('item_description',100)->nullable();
            $table->char('uom',30)->nullable();
            $table->char('qty',20)->nullable();
            $table->char('unit_price',20)->nullable();
            $table->char('total_amount',20)->nullable();
            $table->char('status',20)->nullable();
            $table->date('bos_approved')->nullable();
            $table->date('gm_approved')->nullable();
            $table->date('gh_approved')->nullable();
            $table->date('director_approved')->nullable();
            $table->date('verification')->nullable();
            $table->date('acceptance')->nullable();
            $table->char('deduction', 10)->nullable();
            $table->char('ehs_other_deduction', 20)->nullable();
            $table->char('rp_deduction', 20)->nullable();
            $table->char('scar_no', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('po_ms_huawei');
    }
}
