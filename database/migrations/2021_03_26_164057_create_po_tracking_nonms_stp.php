<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoTrackingNonmsStp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_tracking_nonms_stp', function (Blueprint $table) {
            $table->id();
            $table->integer('id_po_nonms_master')->nullable();
            $table->char('site_id', 25)->nullable();
            $table->char('site_name', 25)->nullable();
            $table->char('region', 30)->nullable();
            $table->char('no_tt', 20)->nullable();
            $table->date('date')->nullable();
            $table->char('pekerjaan', 100)->nullable();
            $table->char('type_service', 10)->nullable();
            $table->char('material', 100)->nullable();
            $table->char('item_code', 30)->nullable();
            $table->integer('qty')->nullable();
            $table->char('unit', 10)->nullable();
            $table->integer('price')->nullable();
            $table->integer('total_price')->nullable();
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
        Schema::dropIfExists('po_tracking_nonms_stp');
    }
}
