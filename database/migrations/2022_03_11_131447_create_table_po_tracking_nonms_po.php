<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePoTrackingNonmsPo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_tracking_nonms_po', function (Blueprint $table) {
            $table->id();
            $table->string('po_number',100)->nullable();
            $table->date('date_po_sc')->nullable();
            $table->date('date_po_sys')->nullable();
            $table->string('contract',100)->nullable();
            $table->date('date_contract')->nullable();
            $table->timestamps();
        });
        
        Schema::table('po_tracking_nonms_master', function (Blueprint $table) {
            $table->integer('po_tracking_nonms_po_id')->nullable();
            $table->index(['po_tracking_nonms_po_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('po_tracking_nonms_po');
    }
}
