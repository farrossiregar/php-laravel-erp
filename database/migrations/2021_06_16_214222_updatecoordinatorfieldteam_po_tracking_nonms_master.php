<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatecoordinatorfieldteamPoTrackingNonmsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_master', function (Blueprint $table) {
            
            $table->string('coordinator_id',200)->nullable();
            $table->integer('status_fieldteam')->nullable();
            $table->integer('status_fielddata')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
