<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldFielProgressToPoMsEricsson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_ms_ericsson', function (Blueprint $table) {
            $table->text('is_regional_reconciliation_file')->nullable();
            $table->text('is_customer_gm_file')->nullable();
            $table->text('is_customer_gh_file')->nullable();
            $table->text('is_customer_od_file')->nullable();
            $table->text('is_verification_file')->nullable();
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
