<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePreventiveMaintenancePunchList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preventive_maintenance_punch_list', function (Blueprint $table) {
            $table->id();
            $table->integer('preventive_maintenance_id')->nullable();
            $table->text('file')->nullable();
            $table->text('note')->nullable();
            $table->boolean('type')->nullable();
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
        Schema::dropIfExists('preventive_maintenance_punch_list');
    }
}
