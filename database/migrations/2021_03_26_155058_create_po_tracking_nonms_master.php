<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoTrackingNonmsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_tracking_nonms_master', function (Blueprint $table) {
            $table->id();
            $table->integer('id_po_nonms_master')->nullable();
            $table->char('po_no', 25)->nullable();
            $table->char('region', 30)->nullable();
            $table->char('site_id', 15)->nullable();
            $table->char('site_name', 15)->nullable();
            $table->char('no_tt', 20)->nullable();
            $table->integer('status')->nullable();
            $table->char('pekerjaan', 100)->nullable();
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
        Schema::dropIfExists('po_tracking_nonms_master');
    }
}
