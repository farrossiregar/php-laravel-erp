<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoTrackingNonmsBoq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_tracking_nonms_boq', function (Blueprint $table) {
            $table->id();
            $table->integer('id_po_nonms_master')->nullable();
            $table->char('project', 30)->nullable();
            $table->char('wo_number', 20)->nullable();
            $table->char('cluster_area', 30)->nullable();
            $table->char('pekerjaan', 100)->nullable();
            $table->char('project_code', 30)->nullable();
            $table->char('item_code', 30)->nullable();
            $table->char('site_id', 25)->nullable();
            $table->char('site_name', 25)->nullable();
            $table->string('item_description')->nullable();
            $table->char('uom', 10)->nullable();
            $table->integer('qty')->nullable();
            $table->char('supplier', 100)->nullable();
            $table->char('region', 30)->nullable();
            $table->char('remark', 30)->nullable();
            $table->char('reff', 30)->nullable();
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
        Schema::dropIfExists('po_tracking_nonms_boq');
    }
}
