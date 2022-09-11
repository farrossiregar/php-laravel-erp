<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToAcceptanceFileToPoTrackingNonmsHuawei extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_huawei', function (Blueprint $table) {
            $table->string('invoice_no',255)->nullable();
            $table->date('invoice_date')->nullable();
            $table->text('acceptance_file')->nullable();
            $table->text('invoice_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acceptance_file_to_po_tracking_nonms_huawei', function (Blueprint $table) {
            //
        });
    }
}
