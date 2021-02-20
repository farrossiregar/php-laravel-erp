<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoTrackingEsar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_tracking_esar', function (Blueprint $table) {
            $table->id();
            $table->char('payment',30)->nullable();
            $table->date('acceptance')->nullable();

            $table->char('site_id',30)->nullable();
            $table->char('site_name', 50)->nullable();
            $table->string('description', 30)->nullable();
            $table->char('uom', 10)->nullable();
            $table->integer('po_qty')->nullable();
            $table->integer('actual_qty')->nullable();
            $table->date('start_date_on_po')->nullable();
            $table->date('end_date_on_po')->nullable();
            $table->string('remarks')->nullable();

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
        Schema::dropIfExists('po_tracking_esar');
    }
}
