<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldStatusToPoMsEricsson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_ms_ericsson', function (Blueprint $table) {
            $table->boolean('status_')->nullable();
            $table->integer('is_have_deduction')->nullable();
            $table->integer('pds_amount')->nullable();
            $table->text('pds_file')->nullable();
        });
        Schema::table('po_ms_huawei', function (Blueprint $table) {
            $table->boolean('status_')->nullable();
            $table->integer('is_have_deduction')->nullable();
            $table->integer('pds_amount')->nullable();
            $table->text('pds_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_ms_ericsson', function (Blueprint $table) {
            //
        });
    }
}
